import $ from 'jquery';

 $(document).ready(function(){

    let entryBody = $("#entry-body");
    $(".insert-add-contact").on('click', addNewContact)
    
   
    const headers = new Headers({
      'Content-Type': 'application/json',
      'X-WP-Nonce': contacts_data.nonce
    });
   
  
    

    // adding new contact

    function addNewContact(){


      Swal.fire({
        title: 'Are you sure?',
        text: "the contact will be added to the database!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b667a9',
        cancelButtonColor: '#ff242ded',
        confirmButtonText: 'Yes!'
      }).then((result) => {
        if (result.value) {
          Swal.fire(
            'Added!',
            'Congrats! you have a new contact',
            'success'
          )
          let name = $(".insert-name").val();
          let lastname = $(".insert-lastname").val();
          let email = $(".insert-email").val();
          let facebook = $(".insert-facebook").val();
          let instagram = $(".insert-instagram").val();
          let linkedin = $(".insert-linkedin").val();

          let dataNewContact = {
            'name' : name,
            'lastname': lastname,
            'email': email,
            'facebook': facebook,
            'instagram': instagram,
            'linkedin': linkedin

          }

          

              fetch(contacts_data.base_url, {
                method: 'post',
                headers: headers,
                credntials: 'same-origin',
                body : JSON.stringify(dataNewContact)
              })
              .then(result =>{

                let id =  $('.contacts-list').find("tr").last().data("id") ;
                //console.log(id);
            
                $( ".contacts-list" ).append( `<tr class="contact-row" data-id="${id + 1}">
                <td><input class="name-field" readonly type="text" value="${dataNewContact["name"]}"></input></td>
                <td><input class="lastname-field" readonly type="text" value="${dataNewContact["lastname"]}"></input></td>
                <td><input class="email-field" readonly type="email" value="${dataNewContact["email"]}"></input></td>
                <td><input class="fb-field" readonly type="text" value="${dataNewContact["facebook"]}"></input></td>
                <td><input class="li-field" readonly type="text" value="${dataNewContact["instagram"]}"></input></td>
                <td><input class="in-field" readonly type="text" value="${dataNewContact["linkedin"]}"></input></td>
                <td><button class="edit-field">Edit</button></td>
                <td><button class="delete-field">Delete</button></td>
                <td><button class="save-btn">Save</button></td>
                 </tr>` );
              
                $('.edit-field').on('click', editField);
                $('.delete-field').on('click', deleteContact);

              }).catch(error => console.log(error))

          }
      })
    }
   
            
      
    // calling endpoint with fetch
    

      fetch(contacts_data.base_url, {
         method: 'get',
         headers: headers,
         credntials: 'same-origin'
      })
      .then(result => {
          return result.json();
      })
      .then( data => {

       
        entryBody.html(`
        <table id="table-contacts">
          <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Facebook</th>
                <th>LinkedIn</th>
                <th>Instagram</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
          </thead>
          <tbody class="contacts-list">
                ${data.allContacts.map(item => `<tr class="contact-row" data-id="${item.id}">
               <td><input class="name-field" readonly type="text" value="${item.name}"></input></td>
               <td><input class="lastname-field" readonly type="text" value="${item.lastname}"></input></td>
               <td><input class="email-field" readonly type="email" value="${item.email}"></input></td>
               <td><input class="fb-field" readonly type="text" value="${item.url_facebook}"></input></td>
               <td><input class="li-field" readonly type="text" value="${item.url_linkedin}"></input></td>
               <td><input class="in-field" readonly type="text" value="${item.url_instagram}"></input></td>
               <td><button class="edit-field">Edit</button></td>
               <td><button class="delete-field">Delete</button></td>
               <td><button class="save-btn">Save</button></td>
               </tr>`).join("")}
             
          </tbody>
        </table>`)
      
        
        
      $('td .edit-field ').on('click', editField);
      $('.delete-field ').on('click', deleteContact);
      }).catch(error => console.log(error));

    
      // function for deleting contacts

      function deleteContact(e){

      e.preventDefault();

            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#b667a9',
              cancelButtonColor: '#ff242ded',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {

                var thisContact = $(e.target).parents("tr");
                var contactId = thisContact.data('id');
            
                let data = {
                    'id': contactId,
                    'mensaje' : 'todo ok'
                  }
                  //console.log(data);
            
                  fetch(contacts_data.base_url, {
                    method: 'delete',
                    headers: headers,
                    credntials: 'same-origin',
                    body: JSON.stringify(data),
                  }).then(function(response) {
                        thisContact.slideUp();
                        Swal.fire(
                          'Deleted!',
                          'Your contact has been deleted.',
                          'success'
                        )
                        })
                        .catch(function(err) {
                            console.log(err);
                        });

              }
            })
  
       
  
        }


        // function to edit a contact

        function editField(e){

          e.preventDefault();
          
          var thisContact = $(e.target).parent("td").parent("tr");
          console.log(thisContact);
          thisContact.find(".name-field, .lastname-field, .email-field, .fb-field, .li-field, .in-field").removeAttr("readonly");
          thisContact.find(".name-field").focus();
          var btnSaveActive = thisContact.find(".save-btn").addClass("save-btn-active");

        btnSaveActive.on('click', updateField);
          

        function updateField(){

          Swal.fire({
            title: 'Are you sure?',
            text: "The data will be replace!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#b667a9',
            cancelButtonColor: '#ff242ded',
            confirmButtonText: 'Yes, update it!'
          }).then((result) => {
            if (result.value) {
              Swal.fire(
                'Updated!',
                'Your contact has been updated.',
                'success'
              )

              let ourUpdatedContact = {
                'name' : thisContact.find(".name-field").val(),
                'lastname' : thisContact.find(".lastname-field").val(),
                'email' : thisContact.find(".email-field").val(),
                'facebook' : thisContact.find(".fb-field").val(),
                'linkedin' : thisContact.find(".li-field").val(),
                'instagram' : thisContact.find(".in-field").val(),
                'id' : thisContact.data('id')
              }

              
    
              //console.log(ourUpdatedContact)
    
              fetch(contacts_data.base_url, {
                method : 'put',
                headers : headers,
                credntials: 'same-origin',
                body: JSON.stringify(ourUpdatedContact),
    
              }).then(function(response){
                thisContact.find(".name-field, .lastname-field, .email-field, .fb-field, .li-field, .in-field").attr('readonly','readonly');
                thisContact.find(".save-btn").removeClass("save-btn-active");

              }).catch(function(err) {
                     console.log(err);
                });
              }
          })
        }
      }
});

 