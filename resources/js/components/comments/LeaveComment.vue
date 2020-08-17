<template>
    <div>
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">

                <div class="form-group">
                    <textarea class="form-control" rows="2" v-model="text"></textarea>
                </div>
                <button class="btn btn-primary" v-on:click="addComment">Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LeaveComment",
    props: {
        postId: Number,
        callbackGetComments: Function
    },
    methods: {
        addComment: function () {
            fetch(`/api/comment`, {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                },
                body: JSON.stringify({
                    message: this.text,
                    post_id: this.postId
                })
            }).then(response => response.json())
            .then(data => {
                if (data.id) {
                    this.text = '';
                    this.callbackGetComments();
                }

            })
        }
    },
    data() {
        return {
            text: ''
        }
    }
}
</script>

<style scoped>

</style>
