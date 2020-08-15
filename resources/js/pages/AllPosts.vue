<template>
    <div>
        <div class="container">
            <button class="btn btn-info" v-on:click="showModalPost(null)">Create post</button>

            <div class=" post-list">
                <Card v-for="post in posts" :key="post.id"
                      v-bind="post"
                      v-bind:callbackEditPost="editPost"
                ></Card>
            </div>

            <PostStoreModal
                v-bind:showModal="showModal"
                v-bind:postId="postId"
                ref="modal"
            />
        </div>
    </div>
</template>

<script>
    import Card from "../components/post/Card";
    import PostStoreModal from "../components/modals/PostStoreModal";

    export default {
        name: "AllPosts",
        components: {PostStoreModal, Card},
        data() {
            return {
                posts: [],
                postId: null,
                showModal: false,
                modalMounted: false
            }
        },
        methods: {
            getPosts: function () {
                fetch('/api/posts')
                    .then(response => {
                        return response.json()
                    })
                    .then(data => {
                        this.posts = data
                        console.log("posts", data)
                    })
            },
            editPost: function (id) {
                this.showModal = true;
                this.showModalPost(id)
            },
            showModalPost: function (id) {
                this.postId = id;
                $(this.$refs.modal.$el).modal('show')
                this.modalMounted = true
            }
        },
        mounted() {
            this.getPosts()
        }
    }
</script>

<style scoped>

</style>
