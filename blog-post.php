<?php require 'include/db_conn.php';
  $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Nitro &mdash; Website Template by Colorlib</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets-nitro/fonts/icomoon/style.css" />

    <link rel="stylesheet" href="assets-nitro/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets-nitro/css/jquery-ui.css" />
    <link rel="stylesheet" href="assets-nitro/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets-nitro/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets-nitro/css/owl.theme.default.min.css" />

    <link rel="stylesheet" href="assets-nitro/css/jquery.fancybox.min.css" />

    <link rel="stylesheet" href="assets-nitro/css/bootstrap-datepicker.css" />

    <link
      rel="stylesheet"
      href="assets-nitro/fonts/flaticon/font/flaticon.css"
    />

    <link rel="stylesheet" href="assets-nitro/css/aos.css" />

    <link rel="stylesheet" href="assets-nitro/css/style.css" />
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

      <header
        class="site-navbar py-4 js-sticky-header site-navbar-target"
        role="banner"
      >
        <div class="container">
          <div class="row align-items-center">
            <div class="col-6 col-xl-2">
              <h1 class="mb-0 site-logo">
                <a href="index.php" class="h2 mb-0"
                  >Nitro<span class="text-primary">.</span>
                </a>
              </h1>
            </div>

            <div class="col-12 col-md-10 d-none d-xl-block">
              <nav
                class="site-navigation position-relative text-right"
                role="navigation"
              >
                <ul
                  class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block"
                >
                  <li>
                    <a href="index.php#home-section" class="nav-link">Home</a>
                  </li>
                  <li class="has-children">
                    <a href="index.php#about-section" class="nav-link"
                      >About Us</a
                    >
                    <ul class="dropdown">
                      <li>
                        <a href="index.php#team-section" class="nav-link"
                          >Team</a
                        >
                      </li>
                      <li>
                        <a href="index.php#pricing-section" class="nav-link"
                          >Pricing</a
                        >
                      </li>
                      <li>
                        <a href="index.php#faq-section" class="nav-link"
                          >FAQ</a
                        >
                      </li>
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

                  <li>
                    <a href="index.php#portfolio-section" class="nav-link"
                      >Portfolio</a
                    >
                  </li>
                  <li>
                    <a href="index.php#services-section" class="nav-link"
                      >Services</a
                    >
                  </li>
                  <li>
                    <a href="index.php#testimonials-section" class="nav-link"
                      >Testimonials</a
                    >
                  </li>
                  <li>
                    <a href="index.php#blog-section" class="nav-link active"
                      >Blog</a
                    >
                  </li>
                  <li>
                    <a href="index.php#contact-section" class="nav-link"
                      >Contact</a
                    >
                  </li>
                </ul>
              </nav>
            </div>

            <div
              class="col-6 d-inline-block d-xl-none ml-md-0 py-3"
              style="position: relative; top: 3px"
            >
              <a href="#" class="site-menu-toggle js-menu-toggle float-right"
                ><span class="icon-menu h3"></span
              ></a>
            </div>
          </div>
        </div>
      </header>
      
      <?php
    // Fetch blog posts from database
    $sql = "SELECT * FROM blog_section WHERE status = 1 AND blog_id = $id ORDER BY publish_date DESC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
?>

      <div
        class="site-blocks-cover overlay"
        style="background-image: url(<?php echo $row['blog_img'] ?>)"
        data-aos="fade"
      >
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-6 mt-lg-5 text-center">
              <h1><?php echo $row['title']; ?></h1>
              <p class="post-meta">
                <?php echo $row['publish_date'] ?> &bull; Posted by <a href="#"><?php echo $row['upload_by'] ?></a> <!--in
                <a href="#">Events</a> -->
              </p>
            </div>
          </div>
        </div>
      </div>

      <section class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-md-8 blog-content">
              <div class="row mb-5">
                <!-- <div class="col-lg-6">
                  <figure>
                    <img
                      src="assets-nitro/images/img_3.jpg"
                      alt="Image"
                      class="img-fluid"
                    />
                    <figcaption>This is an image caption</figcaption>
                  </figure>
                </div>
                <div class="col-lg-6">
                  <figure>
                    <img
                      src="assets-nitro/images/img_4.jpg"
                      alt="Image"
                      class="img-fluid"
                    />
                    <figcaption>This is an image caption</figcaption>
                  </figure>
                </div> -->
              </div>
              <h2>
              <strong><?php echo nl2br($row['title']); ?></strong>
              </h2>
              <div class="mt-4">
                <p>
                  <?php echo nl2br($row['blog_para']); ?>
                </p>
              </div>

              <?php
$blog_cat_query = "SELECT
                      blog_categories.blog_cat
                    FROM
                      blog_section
                    INNER JOIN
                      blog_categories
                    ON
                      blog_section.blogcat_id = blog_categories.blogImg_id
                    WHERE
                      blog_section.blog_id = $id";

$blog_cat_result = $conn->query($blog_cat_query);
if ($blog_cat_result->num_rows > 0) {
    $categories = array(); // Array to store categories
    while ($blog_cat_row = $blog_cat_result->fetch_assoc()) {
        $categories[] = $blog_cat_row['blog_cat'];
    }
?>
<div class="pt-5">
    <p>
        Categories:
        <?php foreach ($categories as $category): ?>
            <a href="#"><?php echo htmlspecialchars($category); ?></a>
        <?php endforeach; ?>
    </p>
</div>
<?php
}
?>


              <!-- <div class="pt-5">
                <h3 class="mb-5">6 Comments</h3>
                <ul class="comment-list">
                  <li class="comment">
                    <div class="vcard bio">
                      <img
                        src="assets-nitro/images/person_1.jpg"
                        alt="Image"
                        class="img-fluid"
                      />
                    </div>
                    <div class="comment-body">
                      <h3>Jean Doe</h3>
                      <div class="meta">January 9, 2018 at 2:21pm</div>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Pariatur quidem laborum necessitatibus, ipsam
                        impedit vitae autem, eum officia, fugiat saepe enim
                        sapiente iste iure! Quam voluptas earum impedit
                        necessitatibus, nihil?
                      </p>
                      <p><a href="#" class="reply">Reply</a></p>
                    </div>
                  </li>

                  <li class="comment">
                    <div class="vcard bio">
                      <img
                        src="assets-nitro/images/person_1.jpg"
                        alt="Image placeholder"
                      />
                    </div>
                    <div class="comment-body">
                      <h3>Jean Doe</h3>
                      <div class="meta">January 9, 2018 at 2:21pm</div>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Pariatur quidem laborum necessitatibus, ipsam
                        impedit vitae autem, eum officia, fugiat saepe enim
                        sapiente iste iure! Quam voluptas earum impedit
                        necessitatibus, nihil?
                      </p>
                      <p><a href="#" class="reply">Reply</a></p>
                    </div>

                    <ul class="children">
                      <li class="comment">
                        <div class="vcard bio">
                          <img
                            src="assets-nitro/images/person_1.jpg"
                            alt="Image placeholder"
                          />
                        </div>
                        <div class="comment-body">
                          <h3>Jean Doe</h3>
                          <div class="meta">January 9, 2018 at 2:21pm</div>
                          <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit. Pariatur quidem laborum necessitatibus, ipsam
                            impedit vitae autem, eum officia, fugiat saepe enim
                            sapiente iste iure! Quam voluptas earum impedit
                            necessitatibus, nihil?
                          </p>
                          <p><a href="#" class="reply">Reply</a></p>
                        </div>

                        <ul class="children">
                          <li class="comment">
                            <div class="vcard bio">
                              <img
                                src="assets-nitro/images/person_1.jpg"
                                alt="Image placeholder"
                              />
                            </div>
                            <div class="comment-body">
                              <h3>Jean Doe</h3>
                              <div class="meta">January 9, 2018 at 2:21pm</div>
                              <p>
                                Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Pariatur quidem laborum
                                necessitatibus, ipsam impedit vitae autem, eum
                                officia, fugiat saepe enim sapiente iste iure!
                                Quam voluptas earum impedit necessitatibus,
                                nihil?
                              </p>
                              <p><a href="#" class="reply">Reply</a></p>
                            </div>

                            <ul class="children">
                              <li class="comment">
                                <div class="vcard bio">
                                  <img
                                    src="assets-nitro/images/person_1.jpg"
                                    alt="Image placeholder"
                                  />
                                </div>
                                <div class="comment-body">
                                  <h3>Jean Doe</h3>
                                  <div class="meta">
                                    January 9, 2018 at 2:21pm
                                  </div>
                                  <p>
                                    Lorem ipsum dolor sit amet, consectetur
                                    adipisicing elit. Pariatur quidem laborum
                                    necessitatibus, ipsam impedit vitae autem,
                                    eum officia, fugiat saepe enim sapiente iste
                                    iure! Quam voluptas earum impedit
                                    necessitatibus, nihil?
                                  </p>
                                  <p><a href="#" class="reply">Reply</a></p>
                                </div>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <li class="comment">
                    <div class="vcard bio">
                      <img
                        src="assets-nitro/images/person_1.jpg"
                        alt="Image placeholder"
                      />
                    </div>
                    <div class="comment-body">
                      <h3>Jean Doe</h3>
                      <div class="meta">January 9, 2018 at 2:21pm</div>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Pariatur quidem laborum necessitatibus, ipsam
                        impedit vitae autem, eum officia, fugiat saepe enim
                        sapiente iste iure! Quam voluptas earum impedit
                        necessitatibus, nihil?
                      </p>
                      <p><a href="#" class="reply">Reply</a></p>
                    </div>
                  </li>
                </ul> -->
                <!-- END comment-list -->

                <!-- <div class="comment-form-wrap pt-5">
                  <h3 class="mb-5">Leave a comment</h3>
                  <form action="#" class="p-5 bg-light">
                    <div class="form-group">
                      <label for="name">Name *</label>
                      <input type="text" class="form-control" id="name" />
                    </div>
                    <div class="form-group">
                      <label for="email">Email *</label>
                      <input type="email" class="form-control" id="email" />
                    </div>
                    <div class="form-group">
                      <label for="website">Website</label>
                      <input type="url" class="form-control" id="website" />
                    </div>

                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea
                        name=""
                        id="message"
                        cols="30"
                        rows="10"
                        class="form-control"
                      ></textarea>
                    </div>
                    <div class="form-group">
                      <input
                        type="submit"
                        value="Post Comment"
                        class="btn btn-primary"
                      />
                    </div>
                  </form>
                </div>
              </div> -->
            </div>
            <div class="col-md-4 sidebar">
              <!-- <div class="sidebar-box">
                <form action="#" class="search-form">
                  <div class="form-group">
                    <span class="icon fa fa-search"></span>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Type a keyword and hit enter"
                    />
                  </div>
                </form>
              </div> -->
              <?php


// Fetch categories with post counts from the database
$categories = [];
$sql = "
    SELECT 
        bc.blogImg_id, 
        bc.blog_cat, 
        COUNT(bs.blogcat_id) AS post_count 
    FROM 
        blog_categories bc 
    LEFT JOIN 
        blog_section bs 
    ON 
        bc.blogImg_id = bs.blogcat_id 
    WHERE 
        bc.status = 1 
    GROUP BY 
        bc.blogImg_id, bc.blog_cat
";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

?>

<div class="sidebar-box">
    <div class="categories">
        <h3>Categories</h3>
        <?php foreach ($categories as $category): ?>
            <li>
                <a href="#">
                    <?php echo htmlspecialchars($category['blog_cat']); ?> 
                    <span>(<?php echo $category['post_count']; ?>)</span>
                </a>
            </li>
        <?php endforeach; ?>
    </div>
</div>

            <!--  <div class="sidebar-box">
                <img
                  src="assets-nitro/images/person_1.jpg"
                  alt="Image placeholder"
                  class="img-fluid mb-4"
                />
                <h3>About The Author</h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Ducimus itaque, autem necessitatibus voluptate quod mollitia
                  delectus aut, sunt placeat nam vero culpa sapiente consectetur
                  similique, inventore eos fugit cupiditate numquam!
                </p>
                <p><a href="#" class="btn btn-primary btn-sm">Read More</a></p>
              </div>

              <div class="sidebar-box">
                <h3>Paragraph</h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  Ducimus itaque, autem necessitatibus voluptate quod mollitia
                  delectus aut, sunt placeat nam vero culpa sapiente consectetur
                  similique, inventore eos fugit cupiditate numquam!
                </p>
              </div>
            </div> -->
          </div>
        </div>
      </section>

    <?php }  ?>

      <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-5">
                  <h2 class="footer-heading mb-4">About Us</h2>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Neque facere laudantium magnam voluptatum autem. Amet
                    aliquid nesciunt veritatis aliquam.
                  </p>
                </div>
                <div class="col-md-3 ml-auto">
                  <h2 class="footer-heading mb-4">Quick Links</h2>
                  <ul class="list-unstyled">
                    <li>
                      <a href="#about-section" class="smoothscroll">About Us</a>
                    </li>
                    <li>
                      <a href="#services-section" class="smoothscroll"
                        >Services</a
                      >
                    </li>
                    <li>
                      <a href="#testimonials-section" class="smoothscroll"
                        >Testimonials</a
                      >
                    </li>
                    <li>
                      <a href="#contact-section" class="smoothscroll"
                        >Contact Us</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <h2 class="footer-heading mb-4">Follow Us</h2>
                  <a href="#" class="pl-0 pr-3"
                    ><span class="icon-facebook"></span
                  ></a>
                  <a href="#" class="pl-3 pr-3"
                    ><span class="icon-twitter"></span
                  ></a>
                  <a href="#" class="pl-3 pr-3"
                    ><span class="icon-instagram"></span
                  ></a>
                  <a href="#" class="pl-3 pr-3"
                    ><span class="icon-linkedin"></span
                  ></a>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
              <form action="#" method="post" class="footer-subscribe">
                <div class="input-group mb-3">
                  <input
                    type="text"
                    class="form-control border-secondary text-white bg-transparent"
                    placeholder="Enter Email"
                    aria-label="Enter Email"
                    aria-describedby="button-addon2"
                  />
                  <div class="input-group-append">
                    <button
                      class="btn btn-primary text-black"
                      type="button"
                      id="button-addon2"
                    >
                      Send
                    </button>
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
                  Copyright &copy;
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  All rights reserved | This template is made with
                  <i class="icon-heart text-danger" aria-hidden="true"></i> by
                  <a href="https://colorlib.com" target="_blank">Colorlib</a>
                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- .site-wrap -->

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
