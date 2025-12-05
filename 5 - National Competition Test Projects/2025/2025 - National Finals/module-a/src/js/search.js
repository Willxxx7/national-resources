/* File path: /js/search.js */

// ============================================
// PORTFOLIO SEARCH & FILTER
// ============================================

document.addEventListener('DOMContentLoaded', function () {
  const Portfolio = {
    config: {
      displayCount: 8,
      portfolioPath: 'img/portfolio/',
      descriptions: {
        wedding: 'Beautiful and timeless wedding day coverage.',
        cars: 'Sleek and dynamic automotive photography.',
        portraits: 'Professional headshots and portraits.',
        nature: 'Stunning natural landscapes and wildlife.',
        family: 'Precious family moments captured forever.',
        party: 'Vibrant celebration and event photography.',
        test: 'Test portfolio images and samples.',
        // More categories and descriptions can be added here
      },
    },

    state: {
      allItems: [],
      filteredItems: [],
      availableCategories: new Set(),
    },

    async init() {
      this.portfolioGrid = document.getElementById('portfolioGrid');
      if (!this.portfolioGrid) return;

      await this.loadPortfolioItems();
      this.createFilterButtons();
      this.bindEvents();
      this.render();
    },

    async loadPortfolioItems() {
      const folders = await this.discoverFolders();
      const allItems = await Promise.all(
        folders.map((folder) => this.detectImages(folder))
      );

      this.state.allItems = allItems.flat();
      this.state.filteredItems = this.state.allItems;

      this.state.allItems.forEach((item) => {
        this.state.availableCategories.add(item.category);
      });
    },

    async discoverFolders() {
      // Discover folders by checking for folder names
      const commonFolders = [
        'artists',
        'birthday',
        'cars',
        'concert',
        'dogs',
        'family',
        'football',
        'graduation',
        'nature',
        'party',
        'portraits',
        'running',
        'show',
        'street-food',
        'wedding',
        'other',
        'test',
      ];

      const existingFolders = [];

      for (const folder of commonFolders) {
        const testPath = `${this.config.portfolioPath}${folder}/${folder}(1).jpg`;
        if (await this.imageExists(testPath)) {
          existingFolders.push(folder);
        }
      }

      return existingFolders;
    },

    async detectImages(folder) {
      const images = [];

      // Try multiple naming patterns
      const patterns = [
        (i) => `${folder}(${i}).jpg`, // folder(1).jpg
        (i) => `${folder}_${i}.jpg`, // folder_1.jpg
        (i) => `${folder}-${i}.jpg`, // folder-1.jpg
        (i) => `image_${i}.jpg`, // image_1.jpg
        (i) => `img_${i}.jpg`, // img_1.jpg
        (i) => `${i}.jpg`, // 1.jpg
      ];

      for (const pattern of patterns) {
        let foundWithPattern = false;

        for (let i = 1; i <= 20; i++) {
          const filename = pattern(i);
          const path = `${this.config.portfolioPath}${folder}/${filename}`;

          if (await this.imageExists(path)) {
            images.push(this.createPortfolioItem(folder, i, path));
            foundWithPattern = true;
          }
        }

        // If a pattern found images, stop trying other patterns
        if (foundWithPattern) break;
      }

      return images;
    },

    imageExists(url) {
      return new Promise((resolve) => {
        const img = new Image();
        img.onload = () => resolve(true);
        img.onerror = () => resolve(false);
        img.src = url;
      });
    },

    createPortfolioItem(folder, index, path) {
      const title = this.formatTitle(folder, index);
      return {
        id: `${folder}-${index}`,
        title,
        category: folder,
        folder,
        image: path,
        description: `${title}. ${this.config.descriptions[folder] || 'A creative project by Spark Studios.'}`,
      };
    },

    formatTitle(folder, index) {
      const formatted =
        folder.charAt(0).toUpperCase() + folder.slice(1).replace(/[-_]/g, ' ');
      return `${formatted} #${index}`;
    },

    createFilterButtons() {
      const filtersContainer = document.querySelector('.portfolio-filters');
      if (!filtersContainer) return;

      const allButton = filtersContainer.querySelector('[data-filter="all"]');
      filtersContainer.innerHTML = '';
      if (allButton) filtersContainer.appendChild(allButton);

      Array.from(this.state.availableCategories)
        .sort()
        .forEach((category) => {
          const button = document.createElement('button');
          button.className = 'btn filter-btn';
          button.dataset.filter = category;
          button.textContent = this.formatCategoryName(category);
          filtersContainer.appendChild(button);
        });
    },

    formatCategoryName(category) {
      return (
        category.charAt(0).toUpperCase() +
        category.slice(1).replace(/[-_]/g, ' ')
      );
    },

    filter(query = '', category = 'all') {
      let items = this.state.allItems;

      if (category !== 'all') {
        items = items.filter((item) => item.category === category);
      }

      if (query.trim()) {
        const searchTerm = query.toLowerCase();
        items = items.filter(
          (item) =>
            item.title.toLowerCase().includes(searchTerm) ||
            item.description.toLowerCase().includes(searchTerm) ||
            item.category.toLowerCase().includes(searchTerm)
        );
      }

      this.state.filteredItems = items;
      this.render();
    },

    render(append = false) {
      const currentCount = append ? this.portfolioGrid.children.length : 0;
      const itemsToShow = this.state.filteredItems.slice(
        currentCount,
        currentCount + this.config.displayCount
      );

      if (!append) this.portfolioGrid.innerHTML = '';

      const html = itemsToShow
        .map(
          (item) => `
          <div class="portfolio-item" data-category="${item.category}">
            <img src="${item.image}" alt="${item.title}" class="portfolio-image" loading="lazy">
          </div>
        `
        )
        .join('');

      this.portfolioGrid.insertAdjacentHTML('beforeend', html);
      this.updateViewMoreButton();
    },

    // View More button
    updateViewMoreButton() {
      const btn = document.querySelector('.portfolio-cta .btn-primary');
      if (!btn) return;
      // Image loading
      const remaining =
        this.state.filteredItems.length - this.portfolioGrid.children.length;

      if (remaining > 0) {
        btn.style.display = 'inline-flex';
        btn.textContent = `View More (${remaining})`;
      } else {
        btn.style.display = 'none';
      }
    },

    bindEvents() {
      const searchInput = document.getElementById('portfolioSearch');
      const viewMoreBtn = document.querySelector('.portfolio-cta .btn-primary');

      const debouncedFilter = this.debounce(() => {
        const activeFilter =
          document.querySelector('.filter-btn.active')?.dataset.filter || 'all';
        this.filter(searchInput?.value || '', activeFilter);
      }, 300);

      searchInput?.addEventListener('input', debouncedFilter);

      document
        .querySelector('.portfolio-filters')
        ?.addEventListener('click', (e) => {
          if (e.target.classList.contains('filter-btn')) {
            document
              .querySelectorAll('.filter-btn')
              .forEach((btn) => btn.classList.remove('active'));
            e.target.classList.add('active');
            debouncedFilter();
          }
        });

      viewMoreBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        this.render(true);
      });
    },

    debounce(func, wait) {
      let timeout;
      return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
      };
    },
  };

  Portfolio.init();
});
