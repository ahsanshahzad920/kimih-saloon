<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kimih Launching Soon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom right, #7b2ff7, #f107a3);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .logo {
            width: 28%;
        }

        .logo-txt {
            font-family: "Helvetica", sans-serif;
            font-size: 20px;
            font-weight: 400;
        }

        h1 {
            font-family: "Times New Roman", serif;
            font-size: 70px;
            line-height: 3.4rem;
        }

        p {
            font-family: "Merriweather", sans-serif;
        }

        .btn {
            font-family: "Helvetica", sans-serif;
        }

        input[type="email"] {
            font-family: "Helvetica", sans-serif;
            max-width: 400px;
            text-align: center;
            margin: 0 auto 20px auto;
            background: rgb(225, 223, 223);
        }

        @media (max-width: 576px) {
            .logo {
                width: 50%;
            }
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <img src="{{ asset('logo/kimih-logo.png') }}" alt="" class="img-fluid logo" />
        <!-- <h6 class="logo-txt mb-3">KIMIH</h6> -->
        <h1>
            Launching <br class="d-none d-md-block" />
            soon!
        </h1>
        <p class="mt-4">
            Join the waiting list for Kimih, the all-in-one
            <br class="d-none d-md-block" />
            beauty and wellness platform
        </p>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @error('email')
            <span class="alert alert-danger mb-3 d-block">{{ $message }}</span>
        @enderror
        <form method="POST" action="{{ route('subscribe.store') }}" class="form-inline">
            @csrf
            <div class="form-group">
                <input type="email" name="email"
                    class="form-control rounded-5 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    placeholder="Enter your email" required />
            </div>
            <button type="submit" class="btn bg-dark text-white rounded-5 px-4">NOTIFY ME</button>
        </form>
        <div class="mt-3 d-flex gap-4 justify-content-center fs-3">
            <a href="{{ siteSocialLinks()->facebook_link ?? '' }}" class="text-white" target="_blank"><i
                    class="fa-brands fa-square-facebook"></i></a>
            <a href="{{ siteSocialLinks()->instagram_link ?? '' }}" class="text-white" target="_blank"><i
                    class="fab fa-instagram"></i></a>
            <a href="{{ siteSocialLinks()->twitter_link ?? '' }}" class="text-white" target="_blank"><i
                    class="fab fa-twitter"></i></a>
        </div>
    </div>

    {{-- <div>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam a ipsum ipsam saepe molestias excepturi
        itaque. Provident delectus, inventore sunt deserunt quae numquam, quo libero id adipisci reprehenderit tenetur.
        Sint fugit ullam ut enim veritatis natus deleniti adipisci, tempora cumque necessitatibus provident consectetur
        nam facere perspiciatis culpa? Dolores consequatur voluptatibus aspernatur nostrum aliquam sint nulla et eos
        maxime, fuga expedita ea aut aperiam minus consequuntur error quaerat ipsum, debitis deserunt dolorum accusamus
        atque magnam dolor! Officia, eveniet ab. Officia doloribus dolores sunt, deleniti ipsam animi ea quia voluptatem
        voluptatibus veniam asperiores quas ex laudantium fugit cupiditate qui tempora autem, recusandae consectetur id
        tenetur iusto. Quidem voluptatem iure labore atque eligendi fuga dolore. Officiis autem eum nihil minus, ullam
        quisquam amet aperiam ducimus adipisci eveniet voluptate repellat odio numquam impedit, dolores laboriosam sit
        laudantium? Eum autem dignissimos placeat, tenetur incidunt explicabo, accusamus neque eveniet voluptatem rem
        vel voluptatibus repellendus quam necessitatibus deserunt minus ratione fugiat earum at. Dolores sequi quo
        ducimus animi earum et magni, fugiat nihil iste aspernatur quibusdam nobis possimus. Recusandae aperiam commodi
        optio a, tempore quam minus explicabo sit quae blanditiis provident molestias autem voluptatem dolore facilis,
        officia inventore laudantium incidunt! Temporibus dolores ipsum est expedita eius iure?
    </div> --}}

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
