<?php


function debug()
{
  // obtener los argumentos pasadas en la invocacion del metodo
  $args = func_get_args();
  echo <<<HTML
    <html>
      <head>
        <style>
          html, body, div, span, applet, object, iframe,
          h1, h2, h3, h4, h5, h6, p, blockquote, pre,
          a, abbr, acronym, address, big, cite, code,
          del, dfn, em, img, ins, kbd, q, s, samp,
          small, strike, strong, sub, sup, tt, var,
          b, u, i, center,
          dl, dt, dd, ol, ul, li,
          fieldset, form, label, legend,
          table, caption, tbody, tfoot, thead, tr, th, td,
          article, aside, canvas, details, embed,
          figure, figcaption, footer, header, hgroup,
          menu, nav, output, ruby, section, summary,
          time, mark, audio, video {
          	margin: 0;
          	padding: 0;
          	border: 0;
          	font-size: 100%;
          	font: inherit;
          	vertical-align: baseline;
          }
          /* HTML5 display-role reset for older browsers */
          article, aside, details, figcaption, figure,
          footer, header, hgroup, menu, nav, section {
          	display: block;
          }
          body {
          	line-height: 1;
          }
          ol, ul {
          	list-style: none;
          }
          blockquote, q {
          	quotes: none;
          }
          blockquote:before, blockquote:after,
          q:before, q:after {
          	content: '';
          	content: none;
          }
          table {
          	border-collapse: collapse;
          	border-spacing: 0;
          }

          html {
            background: #CCC;
          }
          body {
            background : #FFF;
            font-family: Arial, Helvetica, sans-serif;
            width: 90%;
            margin: 1em auto;
            padding: 1em;
            border: solid 1px rgba(0,0,0,0.2);

          }

          body h1 {
            margin-top: 1.5em;
            border-top: solid 1px #CCC;
          }


          body > h1:first-child {
            margin-top : 0px;
            border-top : none;
          }

          pre {
            padding: 1em;
            background: rgba(204, 204, 204, 0.15);
            margin: 1em 0;
            border: solid 1px rgb(239, 239, 239);
          }

        </style>
      </head>

      <body>
HTML;

  foreach( $args as $n => $arg ) {

    echo '<h1> Arg nroº ' . ($n+1) . '</h1>';
    switch(gettype($arg)) {
      case 'object':
      case 'array':
      case 'resource':
          echo '<pre>' . print_r($arg, true) . '</pre>';
        break;
      default:
          echo '<pre>';
          var_dump($arg);
          echo '</pre>';
        break;
    }

  }
  echo <<<HTML
      </body>
    </html>
HTML;
  die;
}
