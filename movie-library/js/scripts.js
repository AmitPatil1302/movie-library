async function searchMovies() {
    const query = document.getElementById('searchQuery').value;
    if (!query) {
        alert('Please enter a search query');
        return;
    }

    const response = await fetch(`http://www.omdbapi.com/?s=${query}&apikey=your_api_key`);
    const data = await response.json();
    const results = document.getElementById('movieResults');
    results.innerHTML = '';

    if (data.Response === "False") {
        results.innerHTML = '<p>No results found</p>';
        return;
    }

    data.Search.forEach(movie => {
        const movieCard = document.createElement('div');
        movieCard.className = 'movie-card';
        movieCard.innerHTML = `<h3>${movie.Title}</h3><p>${movie.Year}</p>`;
        results.appendChild(movieCard);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    loadUserLists();
});

function loadUserLists() {
    const userLists = document.getElementById('userLists');
    userLists.innerHTML = ''; 

    lists.forEach(list => {
        const listCard = document.createElement('div');
        listCard.className = 'list-card';
        listCard.innerHTML = `<h3>${list.name}</h3><p>Movies: ${list.movies.join(', ')}</p>`;
        userLists.appendChild(listCard);
    });
}

function searchMovies() {
    const query = document.getElementById('searchQuery').value;

    fetch(`php/search_movies.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            const resultsSection = document.getElementById('movieResults');
            resultsSection.innerHTML = '';

            if (data.length > 0) {
                data.forEach(movie => {
                    const movieDiv = document.createElement('div');
                    movieDiv.className = 'movie-card';
                    movieDiv.innerHTML = `<h3>${movie.title}</h3>
                                          <p>Director: ${movie.director}</p>
                                          <p>Year: ${movie.year}</p>
                                          <p>Genre: ${movie.genre}</p>`;
                    resultsSection.appendChild(movieDiv);
                });
            } else {
                resultsSection.innerHTML = '<p>No movies found.</p>';
            }
        });
}
