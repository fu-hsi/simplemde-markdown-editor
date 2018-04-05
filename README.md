# SimpleMDE - Markdown Editor

## SimpleMDE documentation
Please check :
[https://github.com/sparksuite/simplemde-markdown-editor](https://github.com/sparksuite/simplemde-markdown-editor)

## This fork's objective

We have made this fork as a simple example of the suggestions made here :
https://github.com/sparksuite/simplemde-markdown-editor/issues/328

@ashleydw made a fair point with his example code, I've compiled a fully working example, with php server side uploading script.

## Try out

Download this project code and then :
```
cd simplemde-markdown-editor
cd dist
php -S localhost:8000
```

Open a browser and go to http://localhost:8000

You can now test and edit the example text, ... and you can drag and drop an image.

## Customize

Images are uploaded inside dist/upload/files. Files are renamed at the upload (I'm used to huge-fan-don-t-want-to-cease-using-spaces-punctuations-and-accents-inside-filenames end users).

Edit the beginning of index.php if you need or use it as starting point for your own code :
- $folder : relative path to the upload folder, from /dist folder
- $max_filesize : size limit for the upload
- $extensions : allowed file extensions
