 document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingInput.value = value; // Set hidden input value
                highlightStars(value);
            });
            
            star.addEventListener('mouseover', function() {
                highlightStars(this.getAttribute('data-value'));
            });

            star.addEventListener('mouseout', function() {
                highlightStars(ratingInput.value);
            });
        });

        function highlightStars(value) {
            stars.forEach(star => {
                if (star.getAttribute('data-value') <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }
    });

