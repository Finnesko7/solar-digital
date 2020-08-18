<template>
    <div class="modal fade" v-bind:class="{show: showModal}" id="modalPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ postId ? 'Edit' : 'Create' }} post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="title" v-model="title">
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <input type="text" class="form-control" id="description" v-model="description">
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-form-label">Image (url):</label>
                            <input type="text" class="form-control" id="image" v-model="image">
                        </div>

                        <div class="form-group">
                            <label for="text" class="col-form-label">Text:</label>
                            <textarea class="form-control" id="text" v-model="text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="postSave">{{ postId ? 'Save' : 'Create' }} post</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostStoreModal",
        props: {
            postId: [Number, null],
            showModal: Boolean,
            callbackCloseModal: Function,
            callbackGetPosts: Function
        },
        data() {
          return {
              title: '',
              description: '',
              image: '',
              text: ''
          }
        },
        methods: {
            getPostById: function () {
                fetch(`/api/post/${this.postId}`).then(response => response.json())
                    .then(data => {
                        this.title = data.title;
                        this.description = data.description;
                        this.image = data.image;
                        this.text = data.text;
                    })
            },
            postSave: function () {
                let post = {
                    title: this.title,
                    description: this.description,
                    image: this.image,
                    text: this.text
                };

                if (this.postId) {
                    fetch(`/api/post/${this.postId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-type': 'application/json; charset=UTF-8'
                        },
                        body: JSON.stringify(post)
                    }).then(response => response.json())
                        .then(post => {
                            if (post) {
                                this.callbackGetPosts();
                                this.callbackCloseModal();
                            }
                        })
                } else {
                    fetch(`/api/post`, {
                        method: 'POST',
                        headers: {
                            'Content-type': 'application/json; charset=UTF-8'
                        },
                        body: JSON.stringify(post)
                    }).then(response => response.json())
                    .then(post => {
                        if(post.id) {
                            this.callbackGetPosts()
                            this.callbackCloseModal();
                        }
                    })
                }
            }
        },
        watch: {
            postId: function () {
                if (this.postId) {
                    this.getPostById()
                } else {
                    this.title = '';
                    this.description = '';
                    this.image = '';
                    this.text = '';
                }
            }
        },
        mounted() {
            if (this.postId) this.getPostById()
        }
    }
</script>

<style scoped>

</style>
