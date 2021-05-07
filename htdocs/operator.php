<?php
include 'config/db.php';
include 'config/autoload.php';
include 'partiels/header.php'; ?>

<body>
<?php
include 'partiels/navBar.php';

$OperatorManager = new TourOperatorManager($pdo);
$ReviewManager = new ReviewManager($pdo);
$DestinationManager = new DestinationManager($pdo);
$ImageManager = new ImageManager($pdo);

if(isset($_POST['id_tour_operator'])):
$operatorData = $OperatorManager->getOperatorById($_POST['id_tour_operator']);
?>
<h1><?= $operatorData['name'] ?></h1>
<div class='row'>
<div class="col-3">
<?php if ($operatorData['is_premium'] === '0') {
                                echo '<img src="https://img.icons8.com/ios/50/000000/fairytale.png" alt="" srcset="">';
                            } else {
                                echo '<img src="https://img.icons8.com/fluent/25/000000/fairytale.png" alt="" srcset=""> ';
                            } ?>
</div>
<div class='col-4'>
                            <?php if ($operatorData['is_premium'] === '1') {
                                echo $operatorData['link'];
                                
                            } ?>
</div>

<div class="col-5">
<?php if ($operatorData['grade']=== null) {
                                echo "<i class='far fa-star'></i>
                                    <i class='far fa-star'></i>
                                    <i class='far fa-star'></i>
                                    <i class='far fa-star'></i>
                                    <i class='far fa-star'></i>";
                            }elseif($operatorData['grade'] < 2){ 
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>";
                            }elseif($operatorData['grade'] < 3){ 
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>";
                            }elseif($operatorData['grade'] < 4){ 
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>";

                            }elseif($operatorData['grade'] < 5){ 
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>";
                            }elseif($operatorData['grade'] < 6){ 
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>";
                            } echo $operatorData['grade'];
                        ?>
</div>
</div>
<?php 
$allDestinations = $DestinationManager->getListDestinationByIdTO($_POST['id_tour_operator']);

foreach ($allDestinations as $destination) {?>
  <div class="row">
  <div class="col-12">
  <button class='btnReviewOperatorEtDestination' id='<?=$destination->getId()?>'> <?=$destination->getLocation()?> </button>
  </div>
  </div>
    
    <div class="hideDestination1" id='hideDestination1<?=$destination->getId()?>'>
    <div>
    
    <?php 
    $imageDestination = $ImageManager->getImageByDestination($destination->getId());?>
     
        <div class="row">
            <div class="col-4">
                        <div class="carousel2 owl-carousel">
                            <?php foreach ($imageDestination as $image) :?>
                                    <img src="<?=$image->getPhoto_Link()?>" alt="" srcset="">                                                   
                            <?php endforeach; ?>
                        </div>
            </div>
        
                <div class="col-1"></div>
                <div class="col-4">
                            <h6><?= $destination->getLocation(); ?></h6>
                        </div>
                        <div class="col-3">
                            <h6> Price  <?= $destination->getPrice(); ?></h6>
                        </div>
</div>
</div>
    </div>

<?php } ?>
<button class='btnFormSearchAjax' id='<?=$destination->getId();?>'>See Reviews</button>
<?php $allReviews = $ReviewManager->getReviewByOperator($operatorData['id']);?>
<div class='reviewsAll' id='reviewsAll<?=$destination->getId();?>'>
            <div class="reviewSearchTourOperator<?=$operatorData['id']?>">
    <?php foreach ($allReviews as $reviews) : ?>
                <div class='row'>
                    <div class='col-3'>
                        <?= $reviews->getAuthor(); ?>
                    </div>
                    <div class='col-1'></div>
                    <div class='col-5'>
                        <?= $reviews->getMessage(); ?>
                    </div>
                    <div class='col-1'></div>
                    <div class='col-2'>
                        <?php switch ($reviews->getGrade_review()) {
                            case null:
                                echo "<i class='far fa-star'></i>
                                    <i class='far fa-star'></i>
                                    <i class='far fa-star'></i>
                                    <i class='far fa-star'></i>
                                    <i class='far fa-star'></i>";
                                break;
                            case 1:
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>";
                                break;

                            case 2:
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>";
                                break;

                            case 3:
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>
                                        <i class='far fa-star'></i>";
                                break;

                            case 4:
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='far fa-star'></i>";
                                break;

                            case 5:
                                echo "  <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>
                                        <i class='fa fa-star text-warning' ></i>";
                                break;
                        } ?>
                    </div>
                </div>
    

            <?php endforeach; ?>
       </div>
    
        <?php include 'forms/form-review-searchTourOperator.php';?>
    
    </div>
 
        
        <?php endif;
            include 'partiels/footer.php';
            include 'partiels/footerScript.php';
        ?>
 