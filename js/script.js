document.addEventListener('DOMContentLoaded', () => {
  console.log("🟢 script.js cargado y DOM listo");

  const products = [
    { id: 1, name: 'Musculosa Abierta "White Shark" - Blanca', price: 20, image: '/ecommerce-Kripton/assets/images/musculosa-shark-blanca.webp' },
    { id: 2, name: 'Musculosa Abierta "Basic-Shark" Negra', price: 20, image: '/ecommerce-Kripton/assets/images/musculosa-shark.webp' },
    { id: 3, name: 'Camisa Oversize "World" - Marron', price: 15, image: '/ecommerce-Kripton/assets/images/oversize-marron.webp' },
    { id: 4, name: 'Camisa Slim Fit - "Shark Original - Verde Militar', price: 25, image: '/ecommerce-Kripton/assets/images/shark-green.webp' },
    { id: 5, name: 'Camisa Oversize "World" - Verde Militar', price: 30, image: '/ecommerce-Kripton/assets/images/oversize-world.webp' },
    { id: 6, name: 'Sudadera Oversize "Patch" - Crudo', price: 35, image: '/ecommerce-Kripton/assets/images/sudadera-blanca.webp' },
  ];

  const productList  = document.getElementById('product-list');
  const cartCount    = document.getElementById('cart-count');
  const searchInput  = document.getElementById('search-input');
  const searchButton = document.getElementById('search-button');
  const noResults    = document.getElementById('no-results');

  function renderProducts(lista = products) {
    productList.innerHTML = '';

    if (lista.length === 0) {
      noResults.style.display = 'block';
      return;
    }
    noResults.style.display = 'none';

    lista.forEach(product => {
      const productElement = document.createElement('div');
      productElement.classList.add('product', 'efecto');
      productElement.innerHTML = `
        <img src="${product.image}" alt="${product.name}">
        <h3>${product.name}</h3>
        <p>$${product.price}</p>
        <div class="button" data-tooltip="PRICE $${product.price}" onclick="addToCart(${product.id})">
          <div class="button-wrapper">
            <div class="text">Add To Cart</div>
            <span class="icon">
              <!-- SVG del carrito -->
            </span>
          </div>
        </div>
      `;
      productList.appendChild(productElement);
    });
  }

  // Mostrar todos al cargar
  renderProducts();

  // Función de búsqueda reutilizable
  function handleSearch() {
    const term = searchInput.value.toLowerCase().trim();

    if (!term) {
      renderProducts();
      return;
    }

    const resultados = products.filter(p =>
      p.name.toLowerCase().includes(term)
    );

    renderProducts(resultados);
  }

  // Click en botón
  searchButton.addEventListener('click', handleSearch);

  // Presionar Enter en el input también dispara búsqueda
  searchInput.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
      handleSearch();
    }
  });

  // Función global para añadir al carrito
  window.addToCart = function(productId) {
    let count = parseInt(cartCount.innerText);
    cartCount.innerText = ++count;
  };
});
