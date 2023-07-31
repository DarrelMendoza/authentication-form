<template>
  <div class="container mt-5 mb-5">
    <div class="d-flex justify-content-center row">
      <div class="d-flex flex-column col-md-8">

        <div class="logout-button"> <!-- New Logout Button -->
          <button class="my_account" type="button" @click="myAccount">My Account</button>
          <button class="btn button" type="button" @click="logout">Logout</button>
        </div>

        <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
          <div class="d-flex flex-column ml-3">

            <div class="d-flex flex-row post-title">
              <h2 style="font-weight: 400;">Hello <u @click="myAccount" style="cursor: pointer;">{{ loggedInUser }}</u>!</h2>
            </div>
          </div>
        </div>


        <div class="coment-bottom bg-white p-2 px-4">

          <div class="post-input mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 5px;"
            @click="hideOptions">
            <h4 class="mt-1" style="text-align: left;">Create a post</h4>
            <form ref="form" @submit.prevent="createPost">
              <input v-model="newPost.title" type="title" class="comment-box" placeholder="Title" rows="5">
              <select v-model="newPost.type" id="postType" class="comment-box mt-2" name="postType">
                <option value="" selected disabled>Select type</option>
                <option value="news">News</option>
                <option value="update">Update</option>
                <option value="task">Task</option>
              </select>
              <textarea v-model="newPost.message" class="comment-box mt-2" placeholder="Write your post here..."
                rows="5"></textarea>
              <button class="button mt-2" type="submit" style="width: 100%;">{{ editMode ? 'Save' : 'Post' }}</button>
            </form>
          </div>
          <div class="post-input mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 5px;">
            <h4 class="mt-1" style="text-align: left;">Recent posts</h4>
            <div v-if="isLoading">
              <div id="loading"></div>
            </div>
            <!-- COMMENT -->
            <div class="commented-section mt-2 post" v-for="comment in comments" :key="comment.id">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center commented-user">
                  <h5>{{ comment.author_name }}</h5>
                  <!-- Replace with the appropriate attribute from your data -->
                  <div class="d-flex flex-row align-items-center align-content-center post-title"
                    style="margin-left: 10px;">
                    <span class="bdge">{{ comment.type }}</span>
                    <!-- Replace with the appropriate attribute from your data -->
                  </div>
                </div>

                <div>
                  <template v-if="showOptions === comment.id && comment.author_id === loggedInUserId">
                    <font-awesome-icon :icon="['fas', 'times']" style="cursor: pointer;"
                      @click="() => { toggleOptions(comment.id); }" />
                  </template>
                  <template v-else-if="comment.author_id === loggedInUserId">
                    <font-awesome-icon :icon="['fas', 'edit']" style="cursor: pointer;"
                      @click="() => { toggleOptions(comment.id); }" />
                  </template>


                  <!-- Options dropdown -->
                  <div v-if="showOptions === comment.id" ref="dropdownRef" class="options-dropdown" tabindex="0">
                    <ul>
                      <li @click.stop="editPost(comment.id, $event)">Edit</li>
                      <li @click.stop="deletePost(comment.id, $event)">Delete</li>
                    </ul>
                    <!-- <button class="button mt-2" type="button" @click.stop="editPost(comment.id, $event)" style="width: 100%;">Edit</button>
            <button class="button mt-2" type="button" @click.stop="deletePost(comment.id, $event)" style="width: 100%;">Delete</button> -->

                  </div>

                </div>
              </div>

              <div class="comment-text-sm" style="text-align: left;">
                <h4>{{ comment.title }}</h4> <!-- Replace with the appropriate attribute from your data -->
                <span>
                  {{ comment.message }} <!-- Replace with the appropriate attribute from your data -->
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref } from 'vue';
import axios from 'axios';

export default {
  name: 'App',
  setup() {
    const showOptions = ref(null);
    const dropdownRef = ref(null);

    const toggleOptions = id => {
      // Function to toggle display of options dropdown
      showOptions.value = showOptions.value === id ? null : id;
    };

    const hideOptions = () => {
      // Function to hide options dropdown when focus is lost
      showOptions.value = null;
    };

    onMounted(() => {
      // Event listener for click events on the document
    });

    onBeforeUnmount(() => {
      // Remove event listener when component is unmounted
    });

    return {
      dropdownRef,
      showOptions,
      toggleOptions,
      hideOptions,
      // ... other data and methods
    };
  },


  data() {
    return {
      isLoading: false, 
      loggedInUser: '',
      loggedInUserId: null,
      editMode: false,
      editPostId: null,
      comments: [],
      newPost: {
        title: '',
        message: '',
        type: '',
        author_name: '',
        author_id: null,
        editIcons: {},
      }
    };
  },
  methods: {


    toggleIcon(id) {
      this.$set(this.editIcons, id, !this.editIcons[id]);
    },


    logout() {
      // Clear user data from local storage
      localStorage.removeItem('loggedInUser');
      localStorage.removeItem('loggedInUserId');
      // Redirect to login page
      this.$router.push('/login'); // Assuming your login route is '/login'
    },

    myAccount() {
      this.$router.push('/my-account'); // Assuming your login route is '/login'
    },

    async fetchComments() {
    this.isLoading = true; // Start loading

    let posts = null;
    let users = null;

    // Simulate minimum loading time of 3 seconds with setTimeout and Promise.all
    const timerPromise = new Promise(resolve => setTimeout(resolve, 3000));

    try {
      const postsResponse = await axios.get('http://localhost:8000/api/posts');
      posts = postsResponse.data;

      const usersPromises = posts.map(post =>
        axios.get(`http://localhost:8000/api/get-account/${post.author_id}`)
      );

      const usersResponses = await Promise.all(usersPromises);
      users = usersResponses.map(userResponse => userResponse.data.user);
    } catch (error) {
      console.error(error);
    }

    // Wait until both the fetching and the timer are done
    await timerPromise;

    // Assign fetched data to this.comments
    if (posts && users) {
      posts.forEach((post, index) => {
        post.author_name = `${users[index].first_name} ${users[index].last_name}`;
      });

      this.comments = posts;
    }

    this.isLoading = false; // Stop loading
  },


    createPost() {
      if (this.newPost.title.trim() === '' || this.newPost.message.trim() === '') {
        let toast = this.$toasted.show("Please ensure your post has a title and a message", {
              theme: "outline",
              position: "top-right",
              duration: 3000,
              type: "info"
            });
        return;
      }

      this.newPost.author_id = this.loggedInUserId;
      if (this.editMode) {
        axios.put(`http://localhost:8000/api/posts/${this.editPostId}`, this.newPost)
          .then(response => {
            const index = this.comments.findIndex(comment => comment.id === this.editPostId);
            this.comments[index] = response.data;
            this.resetForm();
          })
          .catch(error => {
            console.error(error);
          });
      } else {
        // Here is where you should handle creation of new posts.
        axios.post('http://localhost:8000/api/posts', this.newPost)
          .then(response => {
            // Add the new post to the comments array.
            this.comments.unshift(response.data);
            this.resetForm();
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    editPost(id, event) {
      event.stopPropagation();
      const post = this.comments.find(comment => comment.id === id);
      this.populateForm(post);
      this.showOptions = null;
      this.editMode = true;
      this.editPostId = id;
      this.toggleIcon(id); // reset the icon
    },
    populateForm(post) {
      this.newPost = { ...post };
    },
    resetForm() {
      this.editMode = false;
      this.editPostId = null;
      this.newPost = { title: '', message: '', type: '', author_name: this.loggedInUser, author_id: this.loggedInUserId };
      this.$refs.form.reset(); // Reset the form using the 'ref'
    },
    deletePost(postId, event) {
      event.stopPropagation();
      axios.delete(`http://localhost:8000/api/posts/${postId}`)
        .then(() => {
          // Remove the deleted post from the comments array
          this.comments = this.comments.filter(comment => comment.id !== postId);
          this.toggleIcon(postId); // reset the icon
        })
        .catch(error => {
          console.error(error);
        });
    }

  },
  created() {
  // Get logged-in user from local storage
    this.loggedInUser = localStorage.getItem('loggedInUser');
    this.loggedInUserId = Number(localStorage.getItem('loggedInUserId'));
    this.newPost.author_name = this.loggedInUser; // Update author_name when the component is created
    this.newPost.author_id = this.loggedInUserId; // Update author_id when the component is created
    this.fetchComments();
  },
  handleOptionChange(event) {
    if (event.target.value === 'edit') {
      this.editPost();
    } else if (event.target.value === 'delete') {
      this.deletePost();
    }
    event.target.selectedIndex = 0; // Reset the selected option
  },
  handleOutsideClick() {
    this.showOptions = null;
  },
}
</script>



<style scoped>

.my_account {
  background-color: white;
  border: none;
}

.my_account:hover {
  background-color: #fff;  /* light grey background on hover */
}

svg:focus {
  outline: none;
}


.options-dropdown {
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.options-dropdown ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.options-dropdown ul li {
  padding: 12px 16px;
  cursor: pointer;
}

.options-dropdown ul li:hover {
  background-color: #ddd;
}

.comment-box {
  padding: 12px;
  border: 1px solid #d2d2d2;
  border-radius: 5px;
  font-size: 16px;
  color: #212529;
  background-color: #fff;
  width: 100%;
}

.logout-button {
  align-self: flex-end;
  /* Align the button to the right */
}

.post {
  padding: 20px;
  border: 1px solid #d2d2d2;
  border-radius: 5px;
}

.button {
  padding: 10px;
  background-color: #212529;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: background-color 0.2s ease-in-out;
}

button:hover {
  background-color: #424649;
}

.bdge {
  height: 21px;
  background-color: #424649;
  color: #fff;
  font-size: 11px;
  padding: 8px;
  border-radius: 4px;
  line-height: 3px;
}

.comments {
  text-decoration: underline;
  text-underline-position: under;
  cursor: pointer;
}
.comment-text-sm h4, .comment-text-sm span {
    word-wrap: break-word;
}

#loading {
  display: inline-block;
  width: 50px;
  height: 50px;
  border: 3px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: #000000;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
  to { -webkit-transform: rotate(360deg); }
}


</style>
