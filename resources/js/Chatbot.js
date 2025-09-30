const { useState, useRef, useEffect } = React;

// Custom prompt untuk chatbot
const INITIAL_PROMPT = `Halo, Saya adalah Chatbot PST Menjawab, asisten digital dari Badan Pusat Statistik Kabupaten Tulungagung. 👋📊

Tentang PST:
Pelayanan Statistik Terpadu (PST) adalah layanan satu pintu untuk seluruh pelayanan BPS di Indonesia yang dapat diakses melalui https://pst.bps.go.id yang menyediakan berbagai layanan statistik seperti penjualan publikasi, konsultasi statistik, perpustakaan tercetak dan digital, serta data mikro untuk seluruh Indonesia.

Tentang PST Menjawab:
PST Menjawab adalah layanan konsultasi statistik online yang khusus disediakan oleh PST BPS Kabupaten Tulungagung. Layanan ini bertujuan memudahkan masyarakat Tulungagung dalam mengakses dan memahami data statistik serta mendapatkan bimbingan dalam analisis data untuk wilayah Tulungagung.

Peran Saya Sebagai Chatbot:
Saya adalah asisten digital PST Menjawab 👋📊, siap membantu Anda dengan:
✅ Menjawab pertanyaan umum tentang statistik dan metodologi
✅ Memberikan panduan awal untuk analisis data dan interpretasi
✅ Mengarahkan ke layanan konsultasi yang sesuai kebutuhan
✅ Membantu menemukan sumber data statistik yang relevan

Batasan Layanan:
- Untuk konsultasi mendalam atau analisis khusus yang membutuhkan pendampingan ahli, silakan gunakan layanan Konsultasi Online melalui menu Konsultasi
- Jika ada pertanyaan yang di luar cakupan pengetahuan saya, saya akan mengarahkan Anda ke https://silastik.bps.go.id
- Untuk layanan statistik di luar Tulungagung, silakan kunjungi https://pst.bps.go.id
- Saya tidak dapat memberikan interpretasi resmi atas data BPS, untuk hal tersebut silakan konsultasi langsung dengan petugas kami
- Mohon ajukan pertanyaan dengan jelas dan spesifik disertai konteks atau tujuan dari pertanyaan Anda
- Untuk data terbaru, selalu periksa https://silastik.bps.go.id dan https://bps.go.id
- Gunakan menu Konsultasi untuk diskusi mendalam dengan ahli

Bagaimana saya bisa membantu Anda hari ini? 😊`;

const TRAINING_DATA = {
  "jumlah penduduk": "https://tulungagungkab.bps.go.id/indicator/12/28/2/jumlah-penduduk.html",
  "laju pertumbuhan penduduk": "https://tulungagungkab.bps.go.id/id/statistics-table/1/NTE4NSMx/penduduk-laju-pertumbuhan-penduduk-per-tahun-distribusi-persentase-penduduk-kepadatan-penduduk-rasio-jenis-kelamin-penduduk-di-kabupaten-tulungagung-2020.html",
  "penduduk menurut kelompok umur dan jenis kelamin 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/1/NTcxNSMx/penduduk-menurut-kelompok-umur-dan-jenis-kelamin-di-kabupaten-tulungagung--2023.html",
  "hasil sensus dan laju pertumbuhan antar sensus": "https://tulungagungkab.bps.go.id/id/statistics-table/1/NTcxNiMx/hasil-sensus-penduduk-dan-laju-pertumbuhan-antar-sensus-menurut-kecamatan-di-kabupaten-tulungagung.html",
  "penduduk menurut kecamatan dan agama 2020": "https://tulungagungkab.bps.go.id/id/statistics-table/1/NTI2NCMx/jumlah-penduduk-menurut-kecamatan-dan-agama-yang-dianut-di-kabupaten-tulungagung-2020.html",
  "jumlah rumah makan restoran per kecamatan 2018-2022": "https://tulungagungkab.bps.go.id/id/statistics-table/1/NTg2NyMx/jumlah-rumah-makan-restoran-menurut-kecamatan-di-kabupaten-tulungagung-2018-2022.html",
  "jumlah penduduk miskin 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzEwIyMx/jumlah-dan-persentase-penduduk-miskin-di-kabupaten-tulungagung.html",
  "ipm 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzE1IyMx/indeks-pembangunan-manusia-ipm-di-kabupaten-tulungagung.html",
  "tingkat pengangguran terbuka 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzE3IyMx/tingkat-pengangguran-terbuka-tpt-di-kabupaten-tulungagung.html",
  "angka melek huruf 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzE4IyMx/angka-melek-huruf-di-kabupaten-tulungagung.html",
  "angka harapan hidup 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzEzIyMx/angka-harapan-hidup-di-kabupaten-tulungagung.html",
  "laju inflasi bulanan 2024": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzIwIyMx/laju-inflasi-bulanan-di-kabupaten-tulungagung.html",
  "pdrb atas dasar harga berlaku 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzI1IyMx/pdrb-adhb-menurut-lapangan-usaha-di-kabupaten-tulungagung.html",
  "pdrb atas dasar harga konstan 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzI2IyMx/pdrb-adhk-menurut-lapangan-usaha-di-kabupaten-tulungagung.html",
  "pertumbuhan ekonomi 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzI3IyMx/pertumbuhan-ekonomi-menurut-lapangan-usaha-di-kabupaten-tulungagung.html",
  "jumlah sekolah sd 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzMwIyMx/jumlah-sekolah-dasar-sd-di-kabupaten-tulungagung.html",
  "jumlah sekolah smp 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzMxIyMx/jumlah-sekolah-menengah-pertama-smp-di-kabupaten-tulungagung.html",
  "jumlah sekolah sma 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzMyIyMx/jumlah-sekolah-menengah-atas-sma-di-kabupaten-tulungagung.html",
  "jumlah sekolah smk 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzMzIyMx/jumlah-sekolah-menengah-kejuruan-smk-di-kabupaten-tulungagung.html",
  "jumlah guru sd 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzM0IyMx/jumlah-guru-sekolah-dasar-di-kabupaten-tulungagung.html",
  "jumlah murid sd 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzM1IyMx/jumlah-murid-sekolah-dasar-di-kabupaten-tulungagung.html",
  "angka partisipasi sekolah 2023": "https://tulungagungkab.bps.go.id/id/statistics-table/3/NzM2IyMx/angka-partisipasi-sekolah-di-kabupaten-tulungagung.html"
};
const handleUserQuery = (query) => {
  // Convert query to lowercase for case-insensitive matching
  const lowercaseQuery = query.toLowerCase();

  // Find matching keywords
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

  // Format URLs with clickable links (process this first)
  formattedText = formattedText.replace(
    /(https?:\/\/[^\s]+)/g,
    '<a href="$1" target="_blank" class="text-blue-500 hover:text-blue-700 underline">$1</a>'
  );

  // Format bold text with ** **
  formattedText = formattedText.replace(
    /\*\*((?!\*\*).+?)\*\*/g,
    "<strong>$1</strong>"
  );

  // Format tables
  if (text.includes("|")) {
    const lines = text.split("\n");
    const tableLines = [];
    let inTable = false;

    lines.forEach((line) => {
      if (line.includes("|")) {
        if (!inTable) {
          tableLines.push(
            '<div class="overflow-x-auto"><table class="min-w-full bg-white border-collapse border border-gray-300">'
          );
          inTable = true;
        }

        const cells = line.split("|").filter((cell) => cell.trim());
        if (line.includes("---")) {
          // Skip header separator line
          return;
        }

        const isHeader = tableLines.length === 1;
        tableLines.push("<tr>");
        cells.forEach((cell) => {
          if (isHeader) {
            tableLines.push(
              `<th class="border border-gray-300 px-4 py-2 bg-gray-100">${cell.trim()}</th>`
            );
          } else {
            tableLines.push(
              `<td class="border border-gray-300 px-4 py-2">${cell.trim()}</td>`
            );
          }
        });
        tableLines.push("</tr>");
      } else if (inTable) {
        tableLines.push("</table></div>");
        inTable = false;
      }
    });

    if (inTable) {
      tableLines.push("</table></div>");
    }

    formattedText = text.includes("|") ? tableLines.join("") : formattedText;
  }

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
  const [messages, setMessages] = useState([
    {
      role: "assistant",
      content: INITIAL_PROMPT,
    },
  ]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);
  const [topic, setTopic] = useState("");
  const messagesEndRef = useRef(null);
  const chatContainerRef = useRef(null);

  const scrollToBottom = () => {
    if (chatContainerRef.current) {
      chatContainerRef.current.scrollTop =
        chatContainerRef.current.scrollHeight;
    }
  };

  useEffect(() => {
    scrollToBottom();
  }, [messages, loading]);

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
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ prompt: input })
    });

    const data = await response.json();

    if (data.message) {
        setMessages((prev) => [...prev, { role: 'assistant', content: data.message }]);
    }
} catch (error) {
    console.error('Error parsing response:', error);
    setMessages((prev) => [...prev, { role: 'assistant', content: 'Sorry, something went wrong.' }]);
}


    setLoading(false);
  };

  const handleNewChat = () => {
    setMessages([
      {
        role: "assistant",
        content: INITIAL_PROMPT,
      },
    ]);
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
              className={`flex items-start gap-3 ${
                message.role === "user" ? "justify-end" : ""
              }`}
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
                className={`px-4 py-3 rounded-lg ${
                  message.role === "user"
                    ? "bg-orange-500 text-white rounded-br-none max-w-[80%] ml-auto"
                    : "bg-white max-w-[80%]"
                }`}
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
              <div className="flex-1 px-4 py-3 rounded-lg bg-white">
                Mengetik...
              </div>
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
            style={{
              minHeight: "50px",
              maxHeight: "150px",
              height: "auto",
            }}
            onInput={(e) => {
              // Auto resize textarea based on content
              e.target.style.height = "auto";
              e.target.style.height =
                Math.min(e.target.scrollHeight, 150) + "px";
            }}
            onKeyDown={(e) => {
              // Submit on Enter (without Shift)
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
