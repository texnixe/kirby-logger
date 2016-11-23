<style>
.btn.btn-rounded.reset {
  margin:1rem auto;
  display: inline-block;
  padding: 0.5rem;
  border-radius: 4px;
}
</style>
<ul class="nav nav-list sidebar-list">
  <li>
    <a class="">
      <i class="icon icon-left fa fa-file-text-o"></i>
      <span>Size of logfile: </span>
      <small class="marginalia shiv shiv-left shiv-white"><?= f::niceSize(logger()->getLogfile()) ?></small>
    </a>
  </li>
  <li>
    <a class="btn btn-rounded reset" href="">
      <span>Reset logfile</span>
    </a>
  </li>
</ul>
