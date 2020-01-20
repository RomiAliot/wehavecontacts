<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.workana.com/freelancer/20bd71549fa14e18d066cc10a48ca919?ref=user_dropdown
 * @since      1.0.0
 *
 * @package    We_Have_Contacts
 * @subpackage We_Have_Contacts/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container">

    <section class="entry-header">
      <h3> <?php echo esc_html(get_admin_page_title()); ?> </h3>
    </section>
    <section class="entry-add-contacts">

      <div class="add-contact">
            
                <div class="btn-add-contact">
                    <a class="modal-trigger" href="#modal1">
                      <i class="material-icons add-plus-icon">add_circle</i>
                    </a>
                    <p class=""> Add new contact </p>
                </div>
              
      </div>
      <div class="show-shortcode">
      <p>You can use this shortcode to display contacts in the front-end of your site</p>
      <h5>[whcdisplay]</h5>
      <br>
      <br>
      </div>

      <!-- adding the modal -->
      <div id="modal1" class="modal">
        <div class="modal-content">
          <h4>Add a new contact</h4>
          <div class="row">
            <form class="col s12">
              <div class="row">
                <div class="input-field col s4">
                  <i class="material-icons prefix">face</i>
                  <input id="icon_prefix" type="text" class="validate insert-name">
                  <label for="icon_prefix">First Name</label>
                </div>
                <div class="input-field col s4">
                  <input id="icon_telephone" type="tel" class="validate insert-lastname">
                  <label for="icon_telephone">Last Name</label>
                </div>
                <div class="input-field col s4">
                  <i class="material-icons prefix">contact_mail</i>
                  <input id="icon_prefix" type="text" class="validate insert-email">
                  <label for="icon_prefix">Email</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="icon_prefix" type="text" class="validate insert-linkedin">
                  <label for="icon_prefix">LinkedIn</label>
                </div>
                <div class="input-field col s12">
                  <input id="icon_prefix" type="text" class="validate insert-facebook">
                  <label for="icon_prefix">Facebook</label>
                </div>
                <div class="input-field col s12">
                  <input id="icon_prefix" type="text" class="validate insert-instagram">
                  <label for="icon_prefix">Instagram</label>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect btn-flat insert-add-contact">Add Contact</a>
        </div>
      </div><!-- ending modal-->

    </section>

    <section id="entry-contacts">
      
          <ul class="collapsible">
            <li>
              <div class="collapsible-header btn_show_contacts"><i class="material-icons">assignment_ind</i><p>Show my contacts</p></div>
              <div class="collapsible-body"> <div id="entry-body"></div></div>
            </li>
          </ul>

    </section>

</div><!-- end whole container-->

        