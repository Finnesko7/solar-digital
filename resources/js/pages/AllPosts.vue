<template>
    <div>
        <div class="container">
            <button class="btn btn-info" v-on:click="showModalPost">Create post</button>

            <div class=" post-list">
                <Card v-for="post in posts" :key="post.id"
                      v-bind="post"
                      v-bind:callbackEditPost="editPost"
                ></Card>
            </div>

            <PostModal
                v-if="showModal"
                v-bind:showModal="showModal"
                v-bind:postId="postId"
                @hook:mounted="showModalPost"
                ref="modal"
            />
        </div>
    </div>
</template>

<script>
    import Card from "../components/post/Card";

    const PostModal = () => import("../components/modals/PostStoreModal");

    export default {
        name: "AllPosts",
        components: {PostModal, Card},
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
                this.postId = id;

                if (this.modalMounted) {
                    this.showModalPost()
                }
            },
            showModalPost: function () {
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
