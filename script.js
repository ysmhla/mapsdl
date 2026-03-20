// Theme Toggle Logic
const themeToggle = document.getElementById('themeToggle');
const sunIcon = document.querySelector('.sun-icon');
const moonIcon = document.querySelector('.moon-icon');

const currentTheme = localStorage.getItem('theme') || 'dark';
document.body.dataset.theme = currentTheme;
updateThemeIcons(currentTheme);

themeToggle.addEventListener('click', () => {
    let newTheme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
    document.body.dataset.theme = newTheme;
    localStorage.setItem('theme', newTheme);
    updateThemeIcons(newTheme);
});

function updateThemeIcons(theme) {
    if (theme === 'light') {
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
    } else {
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
    }
}

// Input Helpers
const searchInput = document.getElementById('mapsUrl');
const pasteBtn = document.getElementById('pasteBtn');
const clearBtn = document.getElementById('clearBtn');

searchInput.addEventListener('input', () => {
    if (searchInput.value.length > 0) {
        clearBtn.classList.remove('hidden');
        pasteBtn.classList.add('hidden');
    } else {
        clearBtn.classList.add('hidden');
        pasteBtn.classList.remove('hidden');
    }
});

clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    clearBtn.classList.add('hidden');
    pasteBtn.classList.remove('hidden');
    searchInput.focus();
});

pasteBtn.addEventListener('click', async () => {
    try {
        const text = await navigator.clipboard.readText();
        searchInput.value = text;
        clearBtn.classList.remove('hidden');
        pasteBtn.classList.add('hidden');
    } catch (err) {
        console.error('Failed to read clipboard contents: ', err);
    }
});

// Download Logic
async function forceDownload(url, filename) {
    try {
        const response = await fetch(url);
        const blob = await response.blob();
        const blobUrl = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = blobUrl;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(blobUrl);
        return true;
    } catch (e) {
        window.open(url, '_blank'); // fallback
        return false;
    }
}

document.getElementById('downloadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const url = searchInput.value;
    const resultDiv = document.getElementById('result');
    const loader = document.getElementById('loader');
    const loaderText = document.getElementById('loaderText');
    const submitBtn = document.getElementById('submitBtn');
    const action = document.querySelector('input[name="action"]:checked').value;

    resultDiv.classList.add('hidden');
    loader.classList.remove('hidden');
    loaderText.innerText = 'Processing URL...';
    submitBtn.style.opacity = '0.7';
    submitBtn.style.pointerEvents = 'none';

    fetch('api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ url: url })
    })
    .then(res => res.json())
    .then(async data => {
        if (data.success) {
            if (action === 'download') {
                loaderText.innerText = 'Downloading natively...';
                let filename = data.is_video ? 'mapsdl_video.mp4' : 'mapsdl_image.jpg';
                let success = await forceDownload(data.url, filename);
                
                loader.classList.add('hidden');
                resultDiv.classList.remove('hidden');
                resultDiv.innerHTML = `<div class="success-msg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Media successfully saved or uniquely opened!
                </div>
                <a href="${data.url}" target="_blank" class="download-link" style="font-size: 0.9rem; padding: 0.5rem 1.5rem; margin-top: 1rem;">View Original Link</a>`;
            } else {
                // Preview Logic
                loader.classList.add('hidden');
                resultDiv.classList.remove('hidden');
                let mediaHtml = '';
                if (data.is_video) {
                    mediaHtml = `<div class="media-wrapper">
                                    <video controls autoplay muted playsinline>
                                        <source src="${data.url}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                 </div>`;
                } else {
                    mediaHtml = `<div class="media-wrapper">
                                    <img src="${data.url}" alt="Extracted Google Maps Media">
                                 </div>`;
                }
                
                resultDiv.innerHTML = `${mediaHtml}
                <a href="${data.url}" target="_blank" download class="download-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                    Download High-Definition
                </a>`;
            }
        } else {
            loader.classList.add('hidden');
            resultDiv.classList.remove('hidden');
            resultDiv.innerHTML = `<div class="error-msg">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>Error: ${data.message}</span>
            </div>`;
        }
        submitBtn.style.opacity = '1';
        submitBtn.style.pointerEvents = 'all';
    })
    .catch(err => {
        loader.classList.add('hidden');
        resultDiv.classList.remove('hidden');
        submitBtn.style.opacity = '1';
        submitBtn.style.pointerEvents = 'all';
        resultDiv.innerHTML = `<div class="error-msg">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>Network error processing request. Please check your internet connection.</span>
        </div>`;
    });
});
