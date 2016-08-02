<?php

 $work_query = new WP_Query(array(
    'post_type' => 'crb_work',
    'posts_per_page' => 8,
    'meta_query' => array( // WordPress has all the results, now, return only the events after today's date
            array(
              'key' => '_crb_featured',
              'value' => 'yes',
              'compare' => '=='
              )
        )
  ));



get_header(); ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" id="jumbotron">
        <div class="container">
          <h1>At First In Line we create handcrafted, story-telling, branded videos.</h1>
          <p>Whether you're a startup needing to amplify your voice or a large company expanding into a new product, we can help you put your brand first in line.</p>
          <p>
            <a class="btn btn-lg btn-primary" href="#portfolio" role="button">SEE OUR HARD WORK &raquo;</a>
          </p>
        </div>  
      </div>


      <!-- portfolio -->
      <section id="portfolio">
        <div class="container">
          <div class="row  text-center">
            <h1>OUR WORK</h1>
          </div>
        
          <div class="work no-gutter">
            

            <?php while ( $work_query->have_posts() ) : $work_query->the_post(); ?>

            <?php $vimeo = carbon_get_post_meta(get_the_id(), 'crb_vimeo_id'); ?>

            <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3" data-toggle="modal" data-target="#workModal" data-title="<?php the_title(); ?>" data-vimeo="<?php echo $vimeo; ?>" data-descr="<?php the_content(); ?>">
              <a href="#">
      
                <img src="<?php $imgSrc = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'work-size'); echo $imgSrc[0]; ?>" />
              </a>
              <div class="item-info">
                <h4><?php the_title(); ?></h4>
                <p><?php the_content(); ?></p>
              </div> 
            </div> 

          <?php    endwhile; ?>

                        
        
          </div> 
        </div>  

      </section>  


      <!-- services -->
      <section id="services">
        <div class="container">
          <div class="row  text-center">
            <h1>SERVICES</h1>
          </div>

          <div class="col-lg-offset-1 col-lg-10 col-sm-12">

            <div class="col-sm-4 col-xs-12">
              <div class="service">
                <p class="service-image m-animated">
                  <img src="http://www.filco.tv/wp-content/uploads/2016/01/pencils2.jpg" alt="">
                </p>
                <div class="service-ico">
                  <i class="fa fa-picture-o"></i>
                </div> 
                <div class="service-content">
                  <h3>Design</h3>
                  <ul style="list-style:none;">
                  <li>Concepting</li>
                  <li>Logo Design</li>
                  <li>Storyboards</li>
                  <li>Animatics&nbsp;</li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-xs-12">
              <div class="service">
                <p class="service-image m-animated">
                  <img src="http://www.filco.tv/wp-content/uploads/2016/01/picjumbo.com_HNCK6173.jpg" alt="">
                </p>
                <div class="service-ico">
                  <i class="fa fa-film"></i>
                </div>
                <div class="service-content">
                  <h3>Motion</h3>
                    <ul style="list-style:none;">
                    <li>Motion Graphics</li>
                    <li>2D Animation</li>
                    <li>3D Modeling</li>
                    <li>3D Animation</li>
                    </ul>
                </div>
              </div>
            </div>

            <div class="col-sm-4 col-xs-12">
              <div class="service">
                <p class="service-image m-animated">
                  <img src="http://www.filco.tv/wp-content/uploads/2016/01/picjumbo.com_HNCK5096.jpg" alt="">
                </p>
                <div class="service-ico">
                  <i class="fa fa-video-camera"></i>
                </div>
                <div class="service-content">
                  <h3>Post</h3>
                    <ul style="list-style:none;">
                    <li>Editing</li>
                    <li>Color Correction</li>
                    <li>Voice Over</li>
                    <li>Sound Editing</li>
                    </ul>
                </div>
              </div>
            </div>

          </div>  
        </div>
      </section>   
            <!-- services -->
      <section id="clients">
        <div class="container">
          <div class="row  text-center">
            <h1>CLIENTS</h1>
          </div>

          <div class="row">
            <div class="logo col-lg-2 col-sm-4 col-xs-4">
              <img src="<?php echo get_bloginfo('stylesheet_directory').'/images/cl1.png'; ?>" />
            </div>
            <div class="logo col-lg-2 col-sm-4 col-xs-4">
              <img src="<?php echo get_bloginfo('stylesheet_directory').'/images/cl2.png'; ?>" />
            </div>
            <div class="logo col-lg-2 col-sm-4 col-xs-4">
              <img src="<?php echo get_bloginfo('stylesheet_directory').'/images/cl3.png'; ?>" />
            </div>
            <div class="logo col-lg-2 col-sm-4 col-xs-4">
              <img src="<?php echo get_bloginfo('stylesheet_directory').'/images/cl4.png'; ?>" />
            </div>
            <div class="logo col-lg-2 col-sm-4 col-xs-4">
              <img src="<?php echo get_bloginfo('stylesheet_directory').'/images/cl5.png'; ?>" />
            </div>
            <div class="logo col-lg-2 col-sm-4 col-xs-4">
              <img src="<?php echo get_bloginfo('stylesheet_directory').'/images/cl8.png'; ?>" />
            </div>
          </div> 

        </div>
      </section>


    <section id="contact">

        <div class="container">
            <div class="row  text-center">
                <h1>GET IN TOUCH</h1>
            </div>

            <div class="row">
            
                <div class="col-sm-offset-1 col-sm-7 col-xs-12">
                    <div id="responseForm"></div>

                    <form id="contactForm">                  
                    <div class="form-group">
                        <label for="contact-name">Name</label>
                        <input type="text" class="form-control" id="contact-name" name="contact-name" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="contact-email">Email</label>
                        <input type="email" class="form-control" id="contact-email" name="contact-email" placeholder="">
                    </div>

                    <input class="form-group" style="display:none;" type="text" name="last-name" id="last-name" />
                    <div class="form-group">
                        <label for="contact-reason">What do you want to talk about?</label>
                        <select class="form-control" name="contact-reason">
                            <option>Choose a reason</option>
                            <option value="work">Want to work with us.</option>
                            <option value="career">Wamt to work for us.</option>
                            <option value="question">Have a question.</option>
                            <option value="else">Something else.</option>
                        </select>
                    </div>

                    <div class="form-details">
                        <label for="contact-details">How can we help? Detail please.</label>
                        <textarea class="form-control" rows="3" id="contact-details" name="contact-details"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="contact-submit">SEND</button>
                    </form>
                </div>

                <div class="col-sm-4 contact-info">
                    <div class="contact-txt">
                      <h3>General Inquiries</h3>
                      <p>hi@filco.tv<br/>404-933-9811</p>
                    </div>
                    <div class="contact-txt">  
                      <h3>Job Inquiries</h3>
                      <p>jobs@filco.tv</p>
                    </div>
                    <div class="contact-txt">  
                      <h3>First In Line</h3>
                      <p>Atlanta, GA</p>
                    </div.

                </div>

            </div>
        </div>

    </section>

 
<?php get_sidebar(); ?>
<?php get_footer(); ?>