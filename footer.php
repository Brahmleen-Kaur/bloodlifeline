<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- form validation plugin cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    let navToggle = document.querySelector(".nav__toggle");
    let navWrapper = document.querySelector(".nav__wrapper");

    navToggle.addEventListener("click", function () {
        if (navWrapper.classList.contains("active")) {
            this.setAttribute("aria-expanded", "false");
            this.setAttribute("aria-label", "menu");
            navWrapper.classList.remove("active");
        } else {
            navWrapper.classList.add("active");
            this.setAttribute("aria-label", "close menu");
            this.setAttribute("aria-expanded", "true");
        }
    });



    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>
<script>
    let filter = document.querySelector(".filter");
    let filter_box = document.querySelector(".filter_box");
    console.log(filter);
    filter.addEventListener("click", function () {
        if (filter_box.style.display === "none")
            filter_box.style.display = "block";
        else
            filter_box.style.display = "none";
    });

</script>
<script>
    $(document).ready(function () {
        // jQuery code here

        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return value !== "";
        }, "Please select an option.");

        $('#registerForm').validate({
            rules: {
                firstname: "required",
                lastname: "required",
                dob: "required",
                email: "required",
                phone: "required",
                password: "required",
                everDonatedBloodBefore: "required",
                bloodDonatedOn: "required",
                dateOfGettingInked: "required",
                gender: {
                    valueNotEquals: ""
                },
                anySkinDisease: {
                    valueNotEquals: ""
                }, tattoo: {
                    valueNotEquals: ""
                },
                bloodgroup: {
                    valueNotEquals: ""

                }
            },
            messages: {
                firstname: "First name is required",
                lastname: "Last Name is required",
                dob: "DOB is required",
                email: "Email is required",
                phone: "Phone is required",
                password: "Password is required",
                gender: {
                    valueNotEquals: "Please select a gender."
                },
                anySkinDisease: {
                    valueNotEquals: "Please select a anySkinDisease."
                },
                tattoo: {
                    valueNotEquals: "Please select a tattoo."
                },
                bloodgroup:
                {
                    valueNotEquals: "Please select a Blood Group ."

                }
            }
        });
        $('#anySkinDisease').change(function () {
            if ($(this).val() === 'yes') {
                $('#dateOfGettingInked').prop('disabled', true);
                $('#tattoo').prop('disabled', true);
            } else {
                $('#dateOfGettingInked').prop('disabled', false);
                $('#tattoo').prop('disabled', false);
            }
        });
        var $messageDiv = $(".message");
        if ($messageDiv.length) {
            // Hide the message after 10 seconds
            setTimeout(function () {
                $messageDiv.fadeOut();
            }, 3000);
        }

    });
</script>

<script>
  $(document).ready(function() {
    // Set the interval time (in milliseconds) for auto-scrolling
    var interval = 5000; // Change this value as needed

    var slideIndex = 0;
    showSlides();

    function showSlides() {
      var slides = $(".mySlides");
      var i;

      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }

      slideIndex++;

      if (slideIndex > slides.length) {
        slideIndex = 1;
      }

      slides[slideIndex - 1].style.display = "block";

      setTimeout(showSlides, interval);


      if ($(window).width() <= 768) {
        setTimeout(showSlides, interval);
      }
    }
  });
</script>


</body>

</html>