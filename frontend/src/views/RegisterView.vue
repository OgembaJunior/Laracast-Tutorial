<template>
    
    <section class="h-100 bg-light">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-registration my-4">
            <div class="row g-0">
              <div class="col-xl-6 d-none d-xl-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                  alt="Sample photo" class="img-fluid"
                  style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
              </div>
              <div class="col-xl-6">
                <div class="card-body p-md-5 text-black">
                  <h3 class="mb-5 text-uppercase">Register Your Account</h3>


  
                  <form class='m-5 ps-5 pe-5'  method="POST" @submit="RegisterUser">
                    <p class="mb-3" style="color: red; font-size:small;" id="invalid_error"></p>

                    <div class="form-outline mb-4">
                   
                        <input type="name" id="form3Example9" v-model="name"  class="form-control form-control-lg"  />
                        <label class="form-label" for="form3Example9">Username</label>
                        <p class="mb-3" style="color: red; font-size:small;" id="name_error"></p>

                      </div>

                    <div class="form-outline mb-4">
             
                        <input type="text" id="form3Example9" v-model="email"  class="form-control form-control-lg"  />
                        <label class="form-label" for="form3Example9">Email</label>
                        <p class="mb-3" style="color: red; font-size:small;" id="email_error"></p>

                    </div>
    
                
                    <div class="form-outline mb-4">
            
                        <input type="password" id="form3Example9" v-model="password"  class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example9">Password</label>
                        <p class="mb-3" style="color: red; font-size:small;" id="password_error"></p>

                    </div>
  
                    <div class="form-outline mb-4">
                
                        <input type="password" v-model="password_confirmation" id="form3Example97"   class="form-control form-control-lg" />
                        <label class="form-label" for="form3Example97">Password Confirmation</label>
                    </div>
    
                    <div class="d-flex justify-content-end pt-3">
                        <button type="submit" class="btn btn-dark w-100 btn-lg ms-2 mb-2 text-light">Register</button>
                    </div>

                    <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="/sign-in"
                      style="color: #393f81;">Login here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>

                </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>
    

<script>

export default {
data() {
  return {
    post: [],
    name:"",
    email:"",
    password:"",
    password_confirmation:"",

  };
},
mounted() {

},
methods: {

  async RegisterUser (event) {
      event.preventDefault();
      const credentials = {
        name: this.name, 
        email:this.email, 
        password:this.password,
        password_confirmation:this.password_confirmation 
      };

      console.log(credentials)

      const loginUrl = "http://127.0.0.1:8000/api/register";
      const error = document.getElementById("message")


      if(this.password_confirmation !== this.password)
      {
          error.innerHTML = "Passwords do not match"
      }

      else{
          const response = await fetch(loginUrl, {
            method:"POST",
            headers:{
                'Content-Type': 'application/json',

            },
            body: JSON.stringify(credentials), // body data type must match "Content-Type" header

          });

          const data = await response.json();


          if (!response.ok) 
          {
            if(data.errors.email)
            {
              const error = document.getElementById("email_error")
              error.innerText = data.errors.email
            }
            else
            {
              const error = document.getElementById("email_error")
              error.innerText = ""

            }

            if(data.errors.password)
            {
              const error = document.getElementById("password_error")
              error.innerText = data.errors.password
            }
            else
            {
              const error = document.getElementById("password_error")
              error.innerText = ""

            }

            if(data.errors.name)
            {
              const error = document.getElementById("name_error")
              error.innerText = data.errors.name
            }
            else
            {
              const error = document.getElementById("name_error")
              error.innerText = ""

            }
            
          }

          else
          {
        
              this.$router.push({name:"login"});

          }

      }


  }



  
},
};
</script>
      
  
