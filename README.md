AutoURL
===========

About
-----------
AutoURL is a PHP library that converts given strings into a clickable link with the URL specified. It was created for use with Toxic-Productions sotes and then the decision was made to make the script public.


Usage
----------
This script can be used in just a few steps.

1. Include the autourl library using `include('AutoURL.php');`
2. Create an array of Strings and URLs in this format: `$autourlArray = array('text' => array('url' => 'http://example.com', 'limit' => 0));` (Limit can be set to 0 for unlimited replacements or a value greater than 0 for a limited amount of replacements)
3. Initialise the autourl library like so: `$AutoURL = new AutoURL($autourlArray);`
4. Run output buffering using the library's callback: `ob_start(array($AutoURL,'buffer'));`
5. Add some content to your site
6. Flush the output buffer using `ob_flush();` or `ob_end_flush();`
7. You're done!
 
Example script:
```PHP
<?php
  include('AutoURL.php');
  $autourlArray = array(
    'github' => array(
      'url' => 'http://github.com',
      'limit' => 0
    )
  );
  $AutoURL = new AutoURL($autourlArray);
  ob_start(array($AutoURL,'buffer'));
?>
<p>This project is hosted on github!</p>
<?php
  ob_end_flush();
?>
```
