const { useState, useRef, useEffect } = React;

// Custom prompt untuk chatbot
const INITIAL_PROMPT = `Halo, Saya adalah Chatbot PST Menjawab, asisten digital dari Badan Pusat Statistik Kabupaten Tulungagung. 👋📊
...
`;

const TRAINING_DATA = {
  "jumlah penduduk": "https://tulungagungkab.bps.go.id/indicator/12/28/2/jumlah-penduduk.html",
  // Add the rest of your TRAINING_DATA here...
};

const handleUserQuery = (query) => {
  const lowercaseQuery = query.toLowerCase();

  for (const [keyword, url] of Object.entries(TRAINING_DATA)) {
    if (lowercaseQuery.includes(keyword)) {
      return `Anda dapat menemukan data tentang ${keyword} di link berikut:\n${url}`;
    }
  }

  return "Maaf, saya tidak menemukan data spesifik untuk permintaan Anda. Silakan kunjungi https://tulungagung.bps.go.id untuk melihat katalog data lengkap.";
};

function formatMessage(text) {
  if (!text) return "";

  let formattedText = text;

  // Format URLs with clickable links
  formattedText = formattedText.replace(
    /(https?:\/\/[^\s]+)/g,
    '<a href="$1" target="_blank" class="text-blue-500 hover:text-blue-700 underline">$1</a>'
  );

  // Format bold text with ** **
  formattedText = formattedText.replace(
    /\*\*((?!\*\*).+?)\*\*/g,
    "<strong>$1</strong>"
  );

  // Format tables if needed (optional)
  // Format lists
  formattedText = formattedText.replace(
    /^- (.*)/gm,
    '<li class="list-disc ml-4">$1</li>'
  );
  formattedText = formattedText.replace(
    /^(\d+)\. (.*)/gm,
    '<li class="list-decimal ml-4">$1. $2</li>'
  );

  // Format code blocks
  formattedText = formattedText.replace(
    /```([\s\S]*?)```/g,
    '<pre class="bg-gray-100 p-4 rounded-lg overflow-x-auto"><code>$1</code></pre>'
  );

  // Format inline code
  formattedText = formattedText.replace(
    /`([^`]+)`/g,
    '<code class="bg-gray-100 px-1 rounded">$1</code>'
  );

  // Convert newlines to <br> tags
  formattedText = formattedText.replace(/\n/g, "<br>");

  return formattedText;
}

function Chatbot() {
  const [messages, setMessages] = useState([{
    role: "assistant",
    content: INITIAL_PROMPT,
  }]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const messagesEndRef = useRef(null);
  const chatContainerRef = useRef(null);

  const scrollToBottom = () => {
    if (chatContainerRef.current) {
      chatContainerRef.current.scrollTop = chatContainerRef.current.scrollHeight;
    }
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages, loading]);

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const handleSubmit = async (e) => {
    e.preventDefault();
    if (!input.trim()) return;

    const userMessage = {
        role: "user",
        content: input,
    };
    setMessages((prev) => [...prev, userMessage]);
    setInput("");
    setLoading(true);

    try {
        const response = await fetch('/chatbot/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,  // Add CSRF token to headers
            },
            body: JSON.stringify({ prompt: input }),
        });

        const data = await response.json();
        const botMessage = {
            role: "assistant",
            content: data.message || "Maaf, terjadi kesalahan dalam memproses jawaban.",
        };

        setMessages((prev) => [...prev, botMessage]);
    } catch (error) {
        console.error("Error:", error);
        const errorMessage = {
            role: "assistant",
            content: "Maaf, terjadi kesalahan. Silakan coba lagi.",
        };
        setMessages((prev) => [...prev, errorMessage]);
    }

    setLoading(false);
};


  const handleNewChat = () => {
    setMessages([{
      role: "assistant",
      content: INITIAL_PROMPT,
    }]);
  };

  return (
    <div className="w-full max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
      <div className="flex justify-between mb-4">
        <button
          className="bg-gray-100 text-black py-2 px-6 rounded-full hover:bg-gray-200 transition-colors"
          onClick={() => (window.location.href = "/")}
        >
          Kembali
        </button>
        <button
          className="bg-gray-100 text-black py-2 px-6 rounded-full hover:bg-gray-200 transition-colors"
          onClick={handleNewChat}
        >
          Obrolan Baru
        </button>
      </div>

      <div className="bg-white shadow p-4 flex items-center">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          strokeWidth="2"
          strokeLinecap="round"
          strokeLinejoin="round"
          className="w-6 h-6 text-orange-500 mr-2"
        >
          <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
        </svg>
        <h1 className="text-lg font-semibold">PST Menjawab Chatbot</h1>
      </div>

      {/* Chat messages container */}
      <div
        ref={chatContainerRef}
        className="bg-gray-50 rounded-lg p-4 mb-6 min-h-[400px] max-h-[600px] overflow-y-auto"
      >
        <div className="space-y-4">
          {messages.map((message, index) => (
            <div
              key={index}
              className={`flex items-start gap-3 ${message.role === "user" ? "justify-end" : ""}`}
            >
              {message.role === "assistant" && (
                <div className="shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="text-orange-500"
                  >
                    <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
                  </svg>
                </div>
              )}
              <div
                className={`px-4 py-3 rounded-lg ${message.role === "user" ? "bg-orange-500 text-white rounded-br-none max-w-[80%] ml-auto" : "bg-white max-w-[80%]"}`}
                dangerouslySetInnerHTML={{
                  __html:
                    message.role === "assistant"
                      ? formatMessage(message.content)
                      : message.content,
                }}
              />
              {message.role === "user" && (
                <div className="shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    className="text-gray-500"
                  >
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </div>
              )}
            </div>
          ))}
          {loading && (
            <div className="flex items-start gap-3">
              <div className="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  className="text-orange-500"
                >
                  <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"></path>
                </svg>
              </div>
              <div className="flex-1 px-4 py-3 rounded-lg bg-white">Mengetik...</div>
            </div>
          )}
          <div ref={messagesEndRef} />
        </div>
      </div>

      <form onSubmit={handleSubmit} className="flex gap-3">
        <div className="flex-1">
          <textarea
            value={input}
            onChange={(e) => setInput(e.target.value)}
            placeholder="Ketik pesan Anda..."
            className="w-full px-4 py-3 bg-gray-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 resize-none overflow-y-auto"
            style={{ minHeight: "50px", maxHeight: "150px", height: "auto" }}
            onInput={(e) => {
              e.target.style.height = "auto";
              e.target.style.height = Math.min(e.target.scrollHeight, 150) + "px";
            }}
            onKeyDown={(e) => {
              if (e.key === "Enter" && !e.shiftKey) {
                e.preventDefault();
                handleSubmit(e);
              }
            }}
          />
        </div>
        <button
          type="submit"
          disabled={loading}
          className="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors h-[50px]"
        >
          Kirim
        </button>
      </form>
    </div>
  );
}

window.Chatbot = Chatbot;
