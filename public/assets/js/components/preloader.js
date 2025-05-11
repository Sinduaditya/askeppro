class AskepPreloader {
    constructor() {
        this.init();
        this.bindEvents();
    }

    init() {
        const preloaderHtml = `
            <div class="askep-preloader hide">
                <div class="askep-preloader__content">
                    <div class="askep-preloader__progress">
                        <div class="askep-preloader__progress-bar"></div>
                    </div>
                    <div class="spinner-border text-primary askep-preloader__spinner">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="askep-preloader__text">
                        Memuat ASKEP Pro...
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', preloaderHtml);
        this.preloader = document.querySelector('.askep-preloader');
        this.progressBar = this.preloader.querySelector('.askep-preloader__progress-bar');
        this.progressInterval = null;
    }

    bindEvents() {
        document.addEventListener('ajaxStart', () => this.show());
        document.addEventListener('ajaxComplete', () => this.hide());
        document.addEventListener('submit', (e) => {
            if (!e.target.hasAttribute('data-no-preloader')) {
                this.show();
            }
        });
        window.addEventListener('load', () => this.hide());
        window.addEventListener('beforeunload', () => this.show());
    }

    show() {
        this.preloader.classList.remove('hide');
        this.startProgress();
    }

    hide() {
        this.completeProgress(() => {
            this.preloader.classList.add('hide');
        });
    }

    startProgress() {
        let progress = 0;
        this.updateProgress(0);

        this.progressInterval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress > 90) {
                clearInterval(this.progressInterval);
                progress = 90;
            }
            this.updateProgress(Math.min(progress, 90));
        }, 500);
    }

    completeProgress(callback) {
        clearInterval(this.progressInterval);
        this.updateProgress(100);
        setTimeout(callback, 500);
    }

    updateProgress(progress) {
        this.progressBar.style.width = `${progress}%`;
    }
}

// Initialize preloader
window.askepPreloader = new AskepPreloader();
