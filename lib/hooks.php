<?php
kirby()->hook('panel.site.update', function ($site, $oldSite) {
  logger()->save('site.update', $site->content()->toArray(), $oldSite->content()->toArray());
});
kirby()->hook('panel.page.create', function ($page) {
  logger()->save('page.create', $page->uri());
});
kirby()->hook('panel.page.update', function ($page, $oldpage) {
  logger()->save('page.update', $page->uri(), $page->content()->toArray(), $oldpage->content()->toArray());
});
kirby()->hook('panel.page.delete', function ($page) {
  logger()->save('page.delete', $page->uri());
});
kirby()->hook('panel.page.sort', function ($page) {
  logger()->save('page.sort', $page->uri());
});
kirby()->hook('panel.page.hide', function ($page) {
  logger()->save('page.hide', $page->uri());
});
kirby()->hook('panel.page.move', function ($newPage, $oldPage) {
    logger()->save('page.move', $oldPage->uri(), $newPage->uri());
});
kirby()->hook('panel.file.upload', function ($file) {
  logger()->save('file.upload', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.replace', function ($file, $oldFile) {
  logger()->save('file.replace', $file->page()->uri().'/'.$file->filename(), $file->page()->uri().'/'.$oldFile->filename());
});
kirby()->hook('panel.file.rename', function ($file) {
  logger()->save('file.rename', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.update', function ($file, $oldFile) {
  logger()->save('file.update', $file->page()->uri().'/'.$file->filename(), $file->meta()->toArray(), $oldFile->meta()->toArray());
});
kirby()->hook('panel.file.sort', function ($file) {
  logger()->save('file.sort', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.delete', function ($file) {
  logger()->save('file.delete', $file->page()->uri().'/'.$file->filename());
});
