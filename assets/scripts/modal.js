var movieModal = document.getElementById('movieModal')
movieModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget

    var path = button.getAttribute('data-bs-path')
    var title = button.getAttribute('data-bs-movie-title')

    var movie = $.ajax({
        url: path,
        type: "GET",
        dataType: "json",
        success: function(data) {
            return data;
        }
    });
    // Update the modal's content.
    var modalTitle = movieModal.querySelector('.modal-title')
    var modalDescriptionTitle = movieModal.querySelector('#title')
    var modalDescriptionVotes = movieModal.querySelector('#votes')

    modalTitle.textContent = title
    modalDescriptionTitle.textContent = movie.title
    modalDescriptionVotes.textContent = 'Rate' + movie.vote_average + '/10 (' + movie.vote_count + ' voters)'
})
