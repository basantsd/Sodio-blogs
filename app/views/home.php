<?php include BASE_PATH.'/app/views/include/header.inc.php'; ?>
<main class="container">
    <div class="p-4 rounded text-body-emphasis ">
        
    </div>

    <div class="row mb-2">
        <?php  
        if($posts): 
            foreach($posts as $post):
            ?>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis"><?= $post['category_name'];  ?></strong>
                        <h3 class="mb-0"><?= substr($post['title'], 0, 35) . '...'; ?></h3>
                        <div class="mb-1 text-body-secondary"><?= date('Y M',strtotime($post['publish_date'])) ?></div>
                        <p class="card-text mb-auto"><?= substr($post['description'], 0, 55) . '...'; ?></p>
                        <a href="<?= APP_URL.'/post/'.$post['slug']; ?>" class="icon-link gap-1 icon-link-hover stretched-link">
                            Continue reading
                            <svg class="bi">
                                <use xlink:href="#chevron-right" />
                            </svg>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img style="width: 250px;height: 100%;" src="<?= UPLOAD_URL.$post['image']; ?>" /> 
                    </div>
                </div>
            </div>
        <?php 
        endforeach; 
        endif; 
    ?>

    </div>

</main>
<?php include BASE_PATH.'/app/views/include/footer.inc.php'; ?>