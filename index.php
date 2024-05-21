<?php require 'include/db_conn.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <title>Nitro &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets-nitro/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets-nitro/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets-nitro/css/jquery-ui.css">
    <link rel="stylesheet" href="assets-nitro/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets-nitro/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets-nitro/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="assets-nitro/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="assets-nitro/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="assets-nitro/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="assets-nitro/css/aos.css">

    <link rel="stylesheet" href="assets-nitro/css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>


  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.php" class="h2 mb-0">Nitro<span class="text-primary">.</span> </a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li class="has-children">
                  <a href="#about-section" class="nav-link">About Us</a>
                  <ul class="dropdown">
                    <li><a href="#team-section" class="nav-link">Team</a></li>
                    <li><a href="#pricing-section" class="nav-link">Pricing</a></li>
                    <li><a href="#faq-section" class="nav-link">FAQ</a></li>
                    <li class="has-children">
                      <a href="#">More Links</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                
                <li><a href="#portfolio-section" class="nav-link">Portfolio</a></li>
                <li><a href="#services-section" class="nav-link">Services</a></li>
                <li><a href="#testimonials-section" class="nav-link">Testimonials</a></li>
                <li><a href="#blog-section" class="nav-link">Blog</a></li>
                <li><a href="#contact-section" class="nav-link">Contact</a></li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

    <?php
    // Fetch the image URL from the database
    $front_data = "SELECT * FROM front_section ORDER BY status DESC LIMIT 1"; // Order by status in descending order so that status=1 will come first
    $front_result = $conn->query($front_data);

    if ($front_result->num_rows > 0) {
        $row = $front_result->fetch_assoc();
        $imageURL = $row["front_bg_img"];
        
        // Output the image URL as the background-image value
        echo '<div class="site-blocks-cover overlay" style="background-image: url(' . $imageURL . ');" data-aos="fade" id="home-section">';
        
        // Check if status is 1
        if ($row['status'] == 1) {
            $welcomeMsg = $row["welcome_msg"];
            $para = $row["paragraph"];
            $button_switch = $row["button_switch"];
            
            echo '
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-8 mt-lg-5 text-center">
                            <h1 class="text-uppercase" data-aos="fade-up">' . $welcomeMsg . '</h1>
                            <p class="mb-5 desc"  data-aos="fade-up" data-aos-delay="100">'. $para .'</p>';
                            
            if ($button_switch == 1) {
                echo '<div data-aos="fade-up" data-aos-delay="100">
                          <a href="#contact-section" class="btn smoothscroll btn-primary mr-2 mb-2">Get In Touch</a>
                      </div>';
            }
            
            echo '</div>
                    </div>
                </div>

                <a href="#about-section" class="mouse smoothscroll">
                    <span class="mouse-icon">
                        <span class="mouse-wheel"></span>
                    </span>
                </a>';
        }
        
        echo '</div>'; // Close the div tag
    } else {
        // Handle case where no data is found
        echo '<div class="site-blocks-cover overlay" data-aos="fade" id="home-section">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-8 mt-lg-5 text-center">
                            <h1 class="text-uppercase" data-aos="fade-up">Your Default Welcome Message</h1>
                            <p class="mb-5 desc"  data-aos="fade-up" data-aos-delay="100">Your Default Paragraph</p>
                            <div data-aos="fade-up" data-aos-delay="100">
                                <a href="#contact-section" class="btn smoothscroll btn-primary mr-2 mb-2">Get In Touch</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#about-section" class="mouse smoothscroll">
                    <span class="mouse-icon">
                        <span class="mouse-wheel"></span>
                    </span>
                </a>
            </div>';
    }
?>


<?php 
    // Fetch the data from the database
    $about_data = "SELECT * FROM about_section WHERE status = 1"; // Modify this query based on your table structure and condition
    $about_result = $conn->query($about_data);

    if ($about_result->num_rows > 0) {
        $row = $about_result->fetch_assoc();
        $ab_heading = $row["about_heading"];
        $ab_para = $row["about_paragraph"];
        $ab_list = $row["about_list"];
        $ab_img = $row["about_img"];

        // Explode the string into an array
        $list_items = explode(",", $ab_list);
    
        echo '<div class="site-section cta-big-image" id="about-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center" data-aos="fade">
                        <h2 class="section-title mb-3">About Us</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                        <figure class="circle-bg">
                            <img src="' . $ab_img . '" alt="Image" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                        <div class="mb-4">
                            <h3 class="h3 mb-4 text-black">' . $ab_heading . '</h3>
                            <p>' . $ab_para . '</p>
                        </div>
                        
                        <div class="mb-4">
                            <ul class="list-unstyled ul-check success">';
                                // Loop through the list items array and print each item as a list item
                                foreach ($list_items as $item) {
                                    echo '<li>' . trim($item) . '</li>'; // Trim to remove any leading/trailing whitespace
                                }
                        echo '</ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div>';
    } 
?>


<?php
// Fetch data from the feature_section table
$sql = "SELECT * FROM feature_section WHERE status = 1";
$result = $conn->query($sql);

$features = array(); // Initialize an empty array to store features data

if ($result->num_rows > 0) {
    // Fetch each row of data and store it in the $features array
    while ($row = $result->fetch_assoc()) {
        $features[] = $row;
    }
}

// $conn->close(); // Close the database connection
?>

<?php if (!empty($features)) : ?>
<section class="site-section">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">Our Features</h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus minima neque tempora reiciendis.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="">
                <div class="owl-carousel slide-one-item-alt">
                    <?php foreach ($features as $feature) : ?>
                        <img src="<?php echo htmlspecialchars($feature['fea_img']); ?>" alt="Image" class="img-fluid">
                    <?php endforeach; ?>
                </div>
                <div class="custom-direction">
                    <a href="#" class="custom-prev"><span><span class="icon-keyboard_backspace"></span></span></a>
                    <a href="#" class="custom-next"><span><span class="icon-keyboard_backspace"></span></span></a>
                </div>
            </div>

            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="100">
                <div class="owl-carousel slide-one-item-alt-text">
                    <?php foreach ($features as $feature) : ?>
                        <div>
                            <h2 class="section-title mb-3"><?php echo htmlspecialchars($feature['fea_heading']); ?></h2>
                            <p class="lead"><?php echo htmlspecialchars($feature['fea_subheading']); ?></p>
                            <p><?php echo htmlspecialchars($feature['fea_para']); ?></p>
                            <?php if ($feature['fea_btn'] == 1) : ?>
                                <p><a href="#" class="btn btn-primary mr-2 mb-2">Learn More</a></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>




    
<?php
// Fetch team members from the database
$sql = "SELECT * FROM team_section WHERE status = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>
<section class="site-section border-bottom" id="team-section">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="section-title mb-3" data-aos="fade-up" data-aos-delay="">Our Team</h2>
                <p class="lead" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus minima neque tempora reiciendis.</p>
            </div>
        </div>
        <div class="row">
            <?php
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $memberName = $row["member"];
                $position = $row["position"];
                $fbLink = $row["fb_link"];
                $twitLink = $row["twit_link"];
                $linkedinLink = $row["linkedin_link"];
                $instaLink = $row["insta_link"];
                $memberImg = $row["member_img"];
                $linksStatus = $row["links_status"];
            ?>
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="">
                <div class="team-member">
                    <figure>
                      <?php if ($linksStatus == 1) { ?>
                          <ul class="social">
                              <?php if (!empty($fbLink)) { ?>
                                  <li><a href="<?php echo $fbLink; ?>"><span class="icon-facebook"></span></a></li>
                              <?php } ?>
                              <?php if (!empty($twitLink)) { ?>
                                  <li><a href="<?php echo $twitLink; ?>"><span class="icon-twitter"></span></a></li>
                              <?php } ?>
                              <?php if (!empty($linkedinLink)) { ?>
                                  <li><a href="<?php echo $linkedinLink; ?>"><span class="icon-linkedin"></span></a></li>
                              <?php } ?>
                              <?php if (!empty($instaLink)) { ?>
                                  <li><a href="<?php echo $instaLink; ?>"><span class="icon-instagram"></span></a></li>
                              <?php } ?>
                          </ul>
                        <?php } ?>
                        <img src="<?php echo $memberImg; ?>" alt="Image" class="img-fluid">
                    </figure>
                    <div class="p-3">
                        <h3><?php echo $memberName; ?></h3>
                        <span class="position"><?php echo $position; ?></span>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<?php
} // end if
$result->free_result();
?>

<?php
// Database connection (replace with your actual connection details)
// Assuming $conn is your connection variable

// Fetch active category sections
$cat_query = "SELECT * FROM categories_section WHERE status = 1";
$cat_result = $conn->query($cat_query);

// Fetch images for active categories
$img_query = "
    SELECT ci.cat_img, cs.cat_name 
    FROM categories_imgs ci 
    JOIN categories_section cs 
    ON ci.cat_id = cs.cat_id 
    WHERE cs.status = 1 AND ci.status = 1";
$img_result = $conn->query($img_query);
?>

<section class="site-section" id="portfolio-section">
  <div class="container">
    <div class="row mb-3">
      <div class="col-12 text-center" data-aos="fade">
        <h2 class="section-title mb-3">Portfolio</h2>
      </div>
    </div>
    <div class="row justify-content-center mb-5" data-aos="fade-up">
      <div id="filters" class="filters text-center button-group col-md-7">
        <button class="btn btn-primary active" data-filter="*">All</button>
        <?php
        // Display category buttons
        while ($cat_row = $cat_result->fetch_assoc()) {
          echo '<button class="btn btn-primary" data-filter=".' . $cat_row['cat_name'] . '">' . ucfirst($cat_row['cat_name']) . '</button>';
        }
        ?>
      </div>
    </div>
    <div id="posts" class="row no-gutter">
      <?php
      // Display images
      while ($image_row = $img_result->fetch_assoc()) {
        echo '<div class="item ' . $image_row['cat_name'] . ' col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-4">';
        echo '<a href="' . $image_row['cat_img'] . '" class="item-wrap fancybox" data-fancybox="gallery2">';
        echo '<span class="icon-search2"></span>';
        echo '<img class="img-fluid" src="' . $image_row['cat_img'] . '">';
        echo '</a>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>

    
  
    <section class="site-section border-bottom bg-light" id="services-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title mb-3">Our Services</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            <div class="unit-4">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-startup"></span></div>
              <div>
                <h3>Business Consulting</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="unit-4">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-graphic-design"></span></div>
              <div>
                <h3>Market Analysis</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="unit-4">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-settings"></span></div>
              <div>
                <h3>User Monitoring</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
            <div class="unit-4">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-idea"></span></div>
              <div>
                <h3>Insurance Consulting</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="unit-4">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-smartphone"></span></div>
              <div>
                <h3>Financial Investment</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="unit-4">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-head"></span></div>
              <div>
                <h3>Financial Management</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="site-section testimonial-wrap" id="testimonials-section" data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Testimonials</h2>
          </div>
        </div>
      </div>
      <div class="slide-one-item home-slider owl-carousel">
          <div>
            <div class="testimonial">
              
              <blockquote class="mb-5">
                <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
              </blockquote>

              <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="assets-nitro/images/person_3.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>John Smith</p>
              </figure>
            </div>
          </div>
          <div>
            <div class="testimonial">

              <blockquote class="mb-5">
                <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
              </blockquote>
              <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="assets-nitro/images/person_2.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Christine Aguilar</p>
              </figure>
              
            </div>
          </div>

          <div>
            <div class="testimonial">

              <blockquote class="mb-5">
                <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
              </blockquote>
              <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="assets-nitro/images/person_4.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Robert Spears</p>
              </figure>

              
            </div>
          </div>

          <div>
            <div class="testimonial">

              <blockquote class="mb-5">
                <p>&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur unde reprehenderit aperiam quaerat fugiat repudiandae explicabo animi minima fuga beatae illum eligendi incidunt consequatur. Amet dolores excepturi earum unde iusto.&rdquo;</p>
              </blockquote>
              <figure class="mb-4 d-flex align-items-center justify-content-center">
                <div><img src="assets-nitro/images/person_4.jpg" alt="Image" class="w-50 img-fluid mb-3"></div>
                <p>Bruce Rogers</p>
              </figure>

            </div>
          </div>

        </div>
    </section>

    <section class="site-section bg-light" id="pricing-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center" data-aos="fade-up">
            <h2 class="section-title mb-3">Pricing</h2>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="">
            <div class="pricing">
              <h3 class="text-center text-black">Basic</h3>
              <div class="price text-center mb-4 ">
                <span><span>$47</span> / year</span>
              </div>
              <ul class="list-unstyled ul-check success mb-5">
                
                <li>Officia quaerat eaque neque</li>
                <li>Possimus aut consequuntur incidunt</li>
                <li class="remove">Lorem ipsum dolor sit amet</li>
                <li class="remove">Consectetur adipisicing elit</li>
                <li class="remove">Dolorum esse odio quas architecto sint</li>
              </ul>
              <p class="text-center">
                <a href="#" class="btn btn-secondary">Buy Now</a>
              </p>
            </div>
          </div>

          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing">
              <h3 class="text-center text-black">Premium</h3>
              <div class="price text-center mb-4 ">
                <span><span>$200</span> / year</span>
              </div>
              <ul class="list-unstyled ul-check success mb-5">
                
                <li>Officia quaerat eaque neque</li>
                <li>Possimus aut consequuntur incidunt</li>
                <li>Lorem ipsum dolor sit amet</li>
                <li>Consectetur adipisicing elit</li>
                <li class="remove">Dolorum esse odio quas architecto sint</li>
              </ul>
              <p class="text-center">
                <a href="#" class="btn btn-primary">Buy Now</a>
              </p>
            </div>
          </div>

          <div class="col-md-6 mb-4 mb-lg-0 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="pricing">
              <h3 class="text-center text-black">Professional</h3>
              <div class="price text-center mb-4 ">
                <span><span>$750</span> / year</span>
              </div>
              <ul class="list-unstyled ul-check success mb-5">
                
                <li>Officia quaerat eaque neque</li>
                <li>Possimus aut consequuntur incidunt</li>
                <li>Lorem ipsum dolor sit amet</li>
                <li>Consectetur adipisicing elit</li>
                <li>Dolorum esse odio quas architecto sint</li>
              </ul>
              <p class="text-center">
                <a href="#" class="btn btn-secondary">Buy Now</a>
              </p>
            </div>
          </div>
        </div>
        
        <div class="row site-section" id="faq-section">
          <div class="col-12 text-center" data-aos="fade">
            <h2 class="section-title">Frequently Ask Questions</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            
            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Can I accept both Paypal and Stripe?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>
            
            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
              <h3 class="text-black h4 mb-4">What available is refund period?</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Can I accept both Paypal and Stripe?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>
            
            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
              <h3 class="text-black h4 mb-4">What available is refund period?</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>
          </div>
          <div class="col-lg-6">

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
              <h3 class="text-black h4 mb-4">Where are you from?</h3>
              <p>Voluptatum nobis obcaecati perferendis dolor totam unde dolores quod maxime corporis officia et. Distinctio assumenda minima maiores.</p>
            </div>
            
            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
              <h3 class="text-black h4 mb-4">What is your opening time?</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>

            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-black h4 mb-4">Can I accept both Paypal and Stripe?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>
            
            <div class="mb-5" data-aos="fade-up" data-aos-delay="100">
              <h3 class="text-black h4 mb-4">What available is refund period?</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam assumenda eum blanditiis perferendis.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="site-section" id="about-section">
      <div class="container">
        <div class="row mb-5">
          
          <div class="col-lg-5 ml-auto mb-5 order-1 order-lg-2" data-aos="fade" data-aos="fade-up" data-aos-delay="">
            <img src="assets-nitro/images/about_1.jpg" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-lg-6 order-2 order-lg-1" data-aos="fade">

            <div class="row">

              
              
              <div class="col-md-12 mb-md-5 mb-0 col-lg-6" data-aos="fade-up" data-aos-delay="">
                <div class="unit-4">
                  <div class="unit-4-icon mr-4 mb-3"><span class="text-primary flaticon-head"></span></div>
                  <div>
                    <h3>Web &amp; Mobile Specialties</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis consect.</p>
                    <p class="mb-0"><a href="#">Learn More</a></p>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mb-md-5 mb-0 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="unit-4">
                  <div class="unit-4-icon mr-4 mb-3"><span class="text-primary flaticon-smartphone"></span></div>
                  <div>
                    <h3>Intuitive Thinkers</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis.</p>
                    <p class="mb-0"><a href="#">Learn More</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  
    
    

    <?php
    // Fetch blog posts from database
    $sql = "SELECT * FROM blog_section WHERE status = 1 ORDER BY publish_date DESC";
    $result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0): ?> <!-- Check if there are blog posts -->
    <section class="site-section" id="blog-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade">
                    <h2 class="section-title mb-3">Our Blog</h2>
                </div>
            </div>

            <div class="row">
                <?php
                    // Loop through each blog post
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="">
                            <div class="h-entry">
                                <a href="blog-post.php?id=<?php echo $row['blog_id']; ?>">
                                    <img src="<?php echo $row['blog_img']; ?>" alt="Image" class="img-fluid">
                                </a>
                                <h2 class="font-size-regular"><a href="#"><?php echo $row['title']; ?></a></h2>
                                <div class="meta mb-4"><?php echo $row['upload_by']; ?><span class="mx-2">&bullet;</span><?php echo $row['publish_date']; ?><!--<span class="mx-2">&bullet;</span> <a href="#">News</a>--></div>
                                <p><?php echo substr($row['blog_para'], 0, 150) . '...'; ?></p> <!-- Shortened paragraph -->
                                <p><a href="blog-post.php?id=<?php echo $row['blog_id']; ?>">Continue Reading...</a></p>
                            </div> 
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>


   


    <section class="site-section bg-light" id="contact-section" data-aos="fade">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Contact Us</h2>
          </div>
        </div>
        <div class="row mb-5">
          


          <div class="col-md-4 text-center">
            <p class="mb-4">
              <span class="icon-room d-block h4 text-primary"></span>
              <span>203 Fake St. Mountain View, San Francisco, California, USA</span>
            </p>
          </div>
          <div class="col-md-4 text-center">
            <p class="mb-4">
              <span class="icon-phone d-block h4 text-primary"></span>
              <a href="#">+1 232 3235 324</a>
            </p>
          </div>
          <div class="col-md-4 text-center">
            <p class="mb-0">
              <span class="icon-mail_outline d-block h4 text-primary"></span>
              <a href="#">youremail@domain.com</a>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mb-5">

            

            <form action="#" class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Contact Form</h2> 

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          
        </div>
      </div>
    </section>

    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">About Us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
              </div>
              <div class="col-md-3 ml-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#about-section" class="smoothscroll">About Us</a></li>
                  <li><a href="#services-section" class="smoothscroll">Services</a></li>
                  <li><a href="#testimonials-section" class="smoothscroll">Testimonials</a></li>
                  <li><a href="#contact-section" class="smoothscroll">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
            <form action="#" method="post" class="footer-subscribe">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-black" type="button" id="button-addon2">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
              <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
        
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <script src="assets-nitro/js/jquery-3.3.1.min.js"></script>
  <script src="assets-nitro/js/jquery-ui.js"></script>
  <script src="assets-nitro/js/popper.min.js"></script>
  <script src="assets-nitro/js/bootstrap.min.js"></script>
  <script src="assets-nitro/js/owl.carousel.min.js"></script>
  <script src="assets-nitro/js/jquery.countdown.min.js"></script>
  <script src="assets-nitro/js/jquery.easing.1.3.js"></script>
  <script src="assets-nitro/js/aos.js"></script>
  <script src="assets-nitro/js/jquery.fancybox.min.js"></script>
  <script src="assets-nitro/js/jquery.sticky.js"></script>
  <script src="assets-nitro/js/isotope.pkgd.min.js"></script>

  
  <script src="assets-nitro/js/main.js"></script>
    
  </body>
</html>