<nav aria-label="breadcrumb">
  <?php if (isset($breadcrumb)) : ?>
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
      <?php foreach ($breadcrumb->content as $value) : ?>
        <?php $value = (object) $value; ?>
        <?php if (isset($value->url)) : ?>
          <li class="breadcrumb-item text-sm text-white">
            <a class="text-white" href="<?= $value->url; ?>"><?= $value->title; ?></a>
          </li>
        <?php else : ?>
          <li class="breadcrumb-item text-sm text-white"><?= $value->title; ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ol>
  <?php endif; ?>
  
  <h6 class="font-weight-bolder text-white mb-0"><?= $breadcrumb->title ?? '' ?></h6>
</nav>