document.addEventListener('DOMContentLoaded', _ => {
    const movieList = new MovieList()
})

class MovieList {
    constructor() {
        const movieList = document.querySelectorAll('.peliculas li')
        movieList.forEach(movie => {
            movie.addEventListener('click', e => {
                window.location.href = window.location.origin + '/select_tickets'
            })
        });
    }
}