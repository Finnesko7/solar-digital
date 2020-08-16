<template>
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <h1 class="mt-4">{{ post.title }}</h1>
                <hr>
                <p>Posted on {{ post.created_at }}</p>


                <img class="img-fluid rounded" v-bind:src="post.image" alt="">

                <hr>
                    {{ post.text }}
                <hr>
                <Comment/>
            </div>

            <div class="col-md-4">
                <Search/>
                <Categories/>
                <Side/>
            </div>
        </div>
    </div>
</template>

<script>
import Search from "../components/post/Search";
import Categories from "../components/post/Categories";
import Side from "../components/post/Side";
import Comment from "../components/comments/Comment";


export default {
    name: "SinglePost",
    components: {Search, Categories, Side, Comment},
    props: ['id'],
    data() {
      return {
          post: {}
      }
    },
    methods: {
        getPost: function () {
            fetch(`/api/post/${this.id}`).then(response => response.json())
                .then(data => {
                    this.post = data;
                })
        }
    },
    mounted() {
        this.getPost()
    }
}
</script>

<style scoped>

</style>
