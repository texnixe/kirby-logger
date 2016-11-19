<?php
kirby()->hook('panel.site.update', function ($site) {
  logger()->save('site.update');
});
kirby()->hook('panel.page.create', function ($page) {
  logger()->save('page.create', $page->uri());
});
kirby()->hook('panel.page.update', function ($page) {
  logger()->save('page.update', $page->uri());
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
kirby()->hook('panel.file.replace', function ($file) {
  logger()->save('file.replace', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.rename', function ($file) {
  logger()->save('file.rename', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.update', function ($file) {
  logger()->save('file.update', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.sort', function ($file) {
  logger()->save('file.sort', $file->page()->uri().'/'.$file->filename());
});
kirby()->hook('panel.file.delete', function ($file) {
  logger()->save('file.delete', $file->page()->uri().'/'.$file->filename());
});
