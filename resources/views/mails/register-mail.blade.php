
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body style="background-color: black; color: white; margin: 0; padding: 0">
    <div style="margin: 0 auto; width: 700px">
      <div>
        <img
          style="margin-top: 30px; margin-bottom: 0"
          src="https://i.ibb.co/BTr865F/Movie-quotes-Desktop-movie-quotes-bi-chat-quote-fill.png"
          alt="Movie-quotes-Desktop-movie-quotes-bi-chat-quote-fill"
        />
      </div>
      <h1 style="margin: 0 auto">MOVIE QUOTES</h1>
      <div style="margin: 0 auto">
        <h1>Hola {{$name}}</h1>
        <p style="max-width: 1200px; word-wrap: break-word; color: white">
          Thanks for joining Movie quotes! We really appreciate it. Please click
          the button below to verify your account:
        </p>
        <a
          style="
            background-color: red;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            width: 200px;
            display: inline-block;
            text-align: center;
            text-decoration: none;
          "
         href="{{ env('BASE_URL') }}?email_verify_token={{$token}}"
          >Verify account</a
        >
        <p style="max-width: 1200px; word-wrap: break-word; color: white">
          If clicking doesn't work, you can try copying and pasting it to your
          browser:
        </p>
        <p style="max-width: 1200px; word-wrap: break-word; color: white">
          {{ env('BASE_URL') }}?email_verify_token={{$token}}
        </p>
        <p style="max-width: 1200px; word-wrap: break-word; color: white">
          If you have any problems, please contact us: support@moviequotes.ge
        </p>
        <p style="max-width: 1200px; word-wrap: break-word; color: white">
          MovieQuotes Crew
        </p>
      </div>
    </div>
  </body>
</html>