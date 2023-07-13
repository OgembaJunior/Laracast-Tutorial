<template>
    <section class="vh-100" style="background-color: #ffffff;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-0">
                <div class="col-md-6 col-lg-5 d-none d-md-block">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">

                    <form  method="post" @submit="LoginUser">
                      <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-gem fa-2x me-3" style="color: #000000;"></i>
                      </div>
    
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                      <p class="mb-3" style="color: red; font-size:small;" id="invalid_error"></p>

                      <div class="form-outline mb-4">
                  
                        <input type="text" id="form2Example17" v-model="email" class="form-control form-control-lg" />
                        <label class="form-label" for="form2Example17">Email address</label>
                        <div class="mb-3" style="color: red; font-size:small;" id="email_error"></div>

                      </div>
    
                      <div class="form-outline mb-4">
                  
                        <input type="password" id="form2Example27" v-model="password" class="form-control form-control-lg" />
                        <label class="form-label" for="form2Example27">Password</label>
                        <div class="mb-3" style="color: red; font-size:small;" id="password_error"></div>

                       
                      </div>
    
                      <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-dark btn-lg btn-block">Login</button>
                      </div>
    
                      <a class="small text-muted" href="#!">Forgot password?</a>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/sign-up"
                          style="color: #393f81;">Register here</a></p>
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
    };
  },
  mounted() {
    const user = localStorage.getItem("access_token");
    if(user)
    {
      this.$router.push({name:"home"});
    }
 
  },
  methods: {

   
    async LoginUser (event) {
        event.preventDefault();
        const credentials = {email:this.email, password:this.password};
        const loginUrl = "http://127.0.0.1:8000/api/login";
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

          if(data.errors.invalid)
          {
            const error = document.getElementById("invalid_error")
            error.innerText = data.errors.invalid
          }
          else
          {
            const error = document.getElementById("invalid_error")
            error.innerText = ""

          }
            
        }

        else
        {
      
            localStorage.clear()
            // Initialize the access & refresh token in localstorage.
            localStorage.setItem('access_token', data.token);
            localStorage.setItem('user', data.user.id);
            // this.$router.push({name:"home"});
            window.location="/"


        }

    }


 
    
  },
};
</script>
        
    