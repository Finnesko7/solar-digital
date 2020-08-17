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

                <LeaveComment
                    v-bind:postId="post.id"
                    v-bind:callbackGetComments="getComments"
                />

                <Comment
                    v-for="comment in comments" :key="comment.id"
                    v-bind="comment"
                    v-bind:callbackShowEditModal="showEditModal"
                />
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
import LeaveComment from "../components/comments/LeaveComment";


export default {
    name: "SinglePost",
    components: {LeaveComment, Search, Categories, Side, Comment},
    props: ['id'],
    data() {
      return {
          post: {},
          comments: [],
          message: '',
          commentId: null
      }
    },
    methods: {
        getPost: function () {
            fetch(`/api/post/${this.id}`).then(response => response.json())
                .then(data => {
                    this.post = data;
                })
        },
        getComments: function () {
            fetch(`/api/comments/${this.id}`).then(response => response.json())
                .then(comments => {
                    this.comments = comments.data;
                    console.log("comments:", comments.data)
                })
        },
        showEditModal: function (comment) {
            this.commentId = comment.id;
            this.message = comment.message;

            $(this.$refs.editCommentModal.$el).modal('show')
        }
    },
    mounted() {
        this.getPost()
        this.getComments()
    }
}
</script>

<style scoped>

</style>
