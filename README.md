# MapsDL - Google Maps Media Downloader

**Author:** R. Yash.

MapsDL is a premium, beautifully stylized web application that allows users to instantly parse and extract original, uncompressed High-Definition photos and videos generated natively out of Google Maps user reviews and street panoramas.

### Features
* **Zero APIs Needed:** Exclusively leverages native browser requests and uncompressed URL modifier intercepts to bypass API keys entirely for Review imagery/videos. 
* **SaaS Grade Interface:** Fully built UI with smooth Glassmorphism aesthetic, custom grid tracking, and dynamic dual-theme functionality.
* **Intelligent Media Sorting:** Dynamically senses whether the map asset hides an MP4 video or a static image without user input.
* **Instant Direct Download:** Natively coerces cross-origin blobs straight onto the local device flawlessly.

### Tech Stack
* **Frontend:** Vanilla HTML5, CSS3, JavaScript (ES6+). Zero bloat.
* **Backend:** PHP 8+ (Requires cURL extension for header analysis).

### Installation & Deployment
This project is separated into a static frontend and a lightweight PHP backend handler.

1. **Clone the Repository:**
```bash
git clone https://github.com/your-username/mapsdl.git
```
2. **Deploy to an Apache/Nginx Server:**
Upload all files directly into your web-exposed `/var/www/html` or `/public_html` directory so that `index.php` handles incoming traffic.
3. **Ensure PHP Dependencies:**
Ensure your PHP runtime has `php-curl` and `php-json` installed and enabled. This allows `api.php` to fetch the exact media container headers.

### Contributing
This project is open-source. For feature suggestions or fixes, feel free to submit a pull request!

---
*Created by R. Yash. - 2026.*
