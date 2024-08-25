<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#chat">
        Chat Now
        </button>

        <!-- Modal -->
        <div class="modal fade" id="chat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">Chat With {{ receiver_id }} {{ receiver_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="sendMsg()">
                        <div class="modal-body">
                            <div class="form-group">
                                <textarea v-model="form.msg" class="form-control" rows="3" placeholder="Type Your Message"></textarea>
                                <span class="text-success" v-if="successMessage.message">{{ successMessage.message }}</span>
                                <span class="text-danger" v-if="errors.msg">{{ errors.msg[0] }}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

    export default {
        props: ['receiver_id','receiver_name'],
        data() {
            return {
                form: {
                    msg: "",
                    receiver_id: this.receiver_id,
                },
                errors: {},
                successMessage: {},
            }
        },
        methods: {
            sendMsg() {
                axios.post('/send-message',this.form).then((res) => {
                    this.form.msg = "";
                    this.successMessage = res.data;
                    console.log(res.data);
                }).catch((err) => {
                    this.errors = err.response.data.errors;
                });
            }
        }
    }
</script>
