<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      body {
        background-color: black;
        color: white;
        margin: 0;
        padding: 0;
      }
      a {
        background-color: red;
        border-radius: 10px;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        width: 200px;
        display: inline-block;
        text-align: center;
        text-decoration: none;
      }
      .center-box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      p {
        max-width: 1200px;
        word-wrap: break-word;
      }
      .describe {
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
      h1 {
        margin-top: 0;
      }

      img {
        margin-top: 30px;
        margin-bottom: 0;
      }

      @media (max-width: 600px) {
        .center-box {
          max-width: 400px;
          margin: 0 auto;
        }
        p {
          max-width: 300px;
          word-wrap: break-word;
        }
      }
      @media (max-width: 1000px) {
        .center-box {
          max-width: 600px;
          margin: 0 auto;
        }
        .describe {
          gap: 5px;
        }
        p {
          max-width: 400px;
          font-size: 14px;
          word-wrap: break-word;
        }
        a {
          font-size: 14px;
          padding: 10px 20px;
          width: 100px;
          display: inline-block;
          text-align: center;
        }
        h1 {
          font-size: 20px;
        }
        body {
          margin: 0 30px;
        }
      }
    </style>
  </head>
  <body>
    <div class="center-box">
      <div>
        <img
          src="https://i.ibb.co/BTr865F/Movie-quotes-Desktop-movie-quotes-bi-chat-quote-fill.png"
          alt="Movie-quotes-Desktop-movie-quotes-bi-chat-quote-fill"
        />
      </div>
      <h1>MOVIE QUOTES</h1>
      <div class="describe">
        <h1>Hola {{$name}}</h1>
        <p>
          Thanks for joining Movie quotes! We really appreciate it. Please click
          the button below to verify your account:
        </p>
        <a href="{{ env('BASE_URL') }}?email_verify_token={{$token}}">Verify account</a>
        <p>
          If clicking doesn't work, you can try copying and pasting it to your
          browser:
        </p>
        <p>
          {{ env('BASE_URL') }}?email_verify_token={{$token}}
        </p>
        <p>
          If you have any problems, please contact us: support@moviequotes.ge
        </p>
        <p>MovieQuotes Crew</p>
      </div>
    </div>
  </body>
</html>
