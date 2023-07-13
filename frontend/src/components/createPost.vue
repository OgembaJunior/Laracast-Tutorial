<style>
  /* Style for the tag list container */
  #tag_list {
    margin-top: 5px;
  }

  /* Style for each individual tag */
  #tag_list ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: inline-block;
    background-color: #b5c1ce;
    padding: 5px 10px;
    border-radius: 5px;
    margin-right: 5px;
    margin-bottom: 5px;
  }

  /* Style for the tag text */
  #tag_list ul li {
    display: inline-block;
    margin-right: 5px;
    color: #333;
    font-size: 14px;
    cursor: pointer;
  }

  /* Style for the tag input */
  input[type="text"] {
    width: 100%;
    padding: 5px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
</style>

<template>

    
    <form class="p-4" method="post" @submit="createPost">

        <div class="mb-3 mt-2">
            <label for="exampleInputEmail1" class="form-label">Title:</label>
            <input type="text" v-model="title" class="form-control" id="exampleInputEmail1" >
            <div class="mb-3 mt-2" style="color: red; font-size:small;" id="title_error"></div>
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label me-3">Category:</label>
            <select  v-model="category" >
              <option  v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
            </select>
            <div class="mb-3 mt-2" style="color: red; font-size:small;" id="category_error"></div>

        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Tags:</label>
          <input type="text" id="tag-text" list="tag_list" v-model="tag" class="form-control" placeholder="Must be separated with comma" />
          <div id="tag_list">
            <ul  v-for="tag in responseTags" :value="tag.name" :key="tag.id">
              <li id="tagBox" @click="addTag(tag.name)">
                {{ tag.name }} 
                
              </li>
            </ul>
          </div>
          <div id="emailHelp" class="form-text">You can select more than one. (Click once to add, Click again to remove)</div>
          <div class="mb-3 mt-2" style="color: red; font-size:small;" id="tag_error"></div>

        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Body:</label>
            <textarea name="body" v-model="body" id="" class="form-control" cols="30" rows="10" ></textarea>
            <div class="mb-3 mt-2" style="color: red; font-size:small;" id="body_error"></div>

          </div>
 
        <button type="submit" class="btn btn-outline-dark px-5">Create</button>
    </form>

</template>



<script>


  export default {
  data() {
    return {
      categories: [],
      responseTags: [],
      tag:'',
      title:'',
      body:'',
      category:''


    };
  },
  mounted() {
    const user = localStorage.getItem("access_token");
    if(!user)
    {
      this.$router.push({name:"login"});
    }


    this.fetchCategories();
    this.fetchTags();

  },
  methods: {

    async fetchCategories () {
      const categoryUrl = "http://127.0.0.1:8000/api/categories";

      try {
          const response = await fetch(categoryUrl);
          const data = await response.json();
  
          this.categories = data;

        } catch (error) {
          console.error(error);
        }


    },


    async fetchTags () {
      const tagUrl = "http://127.0.0.1:8000/api/tags";

      try {
          const response = await fetch(tagUrl);
          const data = await response.json();

          this.responseTags = data

        } catch (error) {
          console.error(error);
        }
      
    },

    addTag(clickedTag) {
   
      if (this.tag) {
        // Split the existing tags into an array
        const existingTags = this.tag.split(', ');

        // Check if the clickedTag already exists in the array
        const tagIndex = existingTags.indexOf(clickedTag);

        if (tagIndex !== -1) {
          // If the tag already exists, remove it from the array
          existingTags.splice(tagIndex, 1);
        } else {
          // If the tag doesn't exist, append it to the array
          existingTags.push(clickedTag);
        }

        // Join the modified array back into a string
        this.tag = existingTags.join(', ');
      } else {
        this.tag = clickedTag;
      }

    },


    async createPost (event) {
        event.preventDefault();
        const article = {
            title:this.title, 
            tags:this.tag,
            slug:this.title.toLowerCase(),
            category_id:this.category.toString(),
            user_id:localStorage.getItem("user"),
            body:this.body
          };
          


        const postUrl = "http://127.0.0.1:8000/api/create-post";
        const response = await fetch(postUrl, {
            method:"POST",
            headers:{
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(article), // body data type must match "Content-Type" header

        });

        const data = await response.json();

        if (!response.ok) 
        {
          if(data.errors.title || data.errors.slug)
          {
            const error = document.getElementById("title_error")
            error.innerText = data.errors.title
          }
          else
          {
            const error = document.getElementById("title_error")
            error.innerText = ""

          }

          if(data.errors.category_id)
          {
            const error = document.getElementById("category_error")
            error.innerText = data.errors.category_id
          }
          else
          {
            const error = document.getElementById("category_error")
            error.innerText = ""

          }

          if(data.errors.body)
          {
            const error = document.getElementById("body_error")
            error.innerText = data.errors.body
          }
          else
          {
            const error = document.getElementById("body_error")
            error.innerText = ""

          }

          if(data.errors.tags)
          {
            const error = document.getElementById("tag_error")
            error.innerText = data.errors.tags
          }
          else
          {
            const error = document.getElementById("tag_error")
            error.innerText = ""

          }
          
            
        }

        else
        {
          this.$router.push({name:"home"});
        }

    }
    
  },
};
</script>
        
    