<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="R. Yash.">
    <meta name="description" content="A powerful, free tool to download high-definition media from Google Maps by R. Yash.">
    <title>MapsDL - Premium Google Maps Downloader</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body data-theme="dark">
    <div class="blob-wrapper">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <nav class="navbar glass">
        <div class="nav-content">
            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="url(#logo-grad)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <defs>
                        <linearGradient id="logo-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#3b82f6" />
                            <stop offset="100%" stop-color="#8b5cf6" />
                        </linearGradient>
                    </defs>
                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>
                </svg>
                <span>MapsDL</span>
            </div>
            <div class="nav-links">
                <!-- Action Toggle -->
                <div class="mode-toggle glass hidden-mobile">
                    <label class="segment-pill">
                        <input type="radio" name="action" value="preview" checked>
                        <span class="segment-text">Preview Mode</span>
                    </label>
                    <label class="segment-pill">
                        <input type="radio" name="action" value="download">
                        <span class="segment-text">Direct DL</span>
                    </label>
                </div>

                <!-- Theme Toggle -->
                <button id="themeToggle" class="icon-btn" title="Toggle Light/Dark Theme">
                    <svg class="sun-icon hidden" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                    <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Action Toggle -->
    <div class="mobile-action-bar glass show-mobile">
        <div class="mode-toggle">
            <label class="segment-pill">
                <input type="radio" name="action" value="preview" checked>
                <span class="segment-text">Preview</span>
            </label>
            <label class="segment-pill">
                <input type="radio" name="action" value="download">
                <span class="segment-text">Direct DL</span>
            </label>
        </div>
    </div>

    <main class="hero">
        <div class="hero-content text-center">
            <div class="badge glass">🔥 Native High-Definition Extraction</div>
            <h1 class="title">Extract Original Media from <span class="gradient-text">Google Maps</span></h1>
            <p class="subtitle">Instantly download uncompressed photos and videos hidden in user reviews and panoramas. No API keys required for review URLs.</p>
            
            <form id="downloadForm" class="full-width-form">
                
                <div class="highlight-box">
                    <div class="download-form glass">
                        <div class="input-group">
                            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/><path d="M21 21l-6 -6"/></svg>
                            <input type="text" id="mapsUrl" placeholder="Paste Google Maps URL here (e.g., https://www.google.com/maps/place/...)" required>
                            
                            <button type="button" id="pasteBtn" class="icon-btn small-btn" title="Paste from Clipboard">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                            </button>
                            <button type="button" id="clearBtn" class="icon-btn small-btn hidden" title="Clear input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                        </div>
                        <button type="submit" class="btn-primary" id="submitBtn">
                            <span>Extract Media</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </form>

            <div id="loader" class="loader hidden">
                <div class="spinner"></div>
                <span id="loaderText">Processing URL...</span>
            </div>

            <div id="result" class="result-container hidden glass">
                <!-- Result dynamically populated by JS -->
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2026 MapsDL Downloader. Free Tool by <strong>R. Yash.</strong></p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
