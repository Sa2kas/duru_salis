<template>
    <div class="comments">
        <div class="comments-header"></div>
        <div class="comments-title">
            Klientų atsiliepimai
        </div>
        <div class="comments-data">
            <div class="add-comment" v-if="!authenticated">
                <button class="add-comment-btn" @click="showModal();edit = false">
                    add comment
                </button>
            </div>
            <div class="comment" v-for="comment in items.comments.data" :key="comment.id">
                <div class="comment-delete" v-if="authenticated">
                    <button class="comment-delete-btn" @click="deleteData(comment)">
                        x
                    </button>
                </div>
                <div class="comment-header">
                    <div class="comment-stars" v-for="star in comment.stars" :key="star">
                        <img src="/images/star.png" alt="">
                    </div>
                    <div class="comment-name">{{comment.name}}</div>
                </div>
                <div class="comment-data">duomenys: {{comment.order_id}}</div>
            </div>
        </div>
        <modal 
            v-show="isModalVisible"
            @close="closeModal()"
            :name="edit == true ? 'Redaguoti' : 'Pridėti'">
            <template>
                užsakymo numeris <br>
                <input type="text" v-model="commentForm.order_id"> <br>
                vardas <br>
                <input type="text" v-model="commentForm.name"> <br>
                įvertinimas <br>
                <input type="text" v-model="commentForm.stars"> <br>
                <button @click="closeModal">Cancel</button>
                <button @click="submitItem">Submit</button>
            </template>
      </modal>
    </div>
</template>
<script>
import VueTable from '../components/Table.vue'
import PdfGenerator from '../components/PdfGeneration.vue'
import Modal from '../components/Modal.vue'
export default {
    components: {
        VueTable,
        PdfGenerator,
        Modal
    },
    data() {
        return {
            commentForm: {
                name: '',
                stars: 1,
                order_id: 1,
            },
            comments: [],
            items: {
                comments : {
                    columns: [
                        { dataIndex: 'name', title: 'Vardas' },
                        { dataIndex: 'stars', title: 'zvaigzdes' },
                        { dataIndex: 'order_id', title: 'OrderId' },
                    ],
                    data: []
                },
            },
            edit: false,
            isModalVisible: false,
            origCommentForm: {},
        }
    },
    created() {
        this.origCommentForm = _.cloneDeep(this.commentForm);
        this.fetchCommentData()
    },
    methods: {
        fetchCommentData(){
            axios.get('/api/comments')
            .then(response => {
                this.items.comments.data = response.data.data;
            });
        }, 
        showModal (modalData) {
            this.isModalVisible = true
        },
        closeModal () {
            this.refresh()
            this.isModalVisible = false
        },
        deleteData(comment){
            axios.delete('/api/comments/' + comment.id)
            .then((response) => {
                let item = this.items.comments.data.find(el => el.id == comment.id)
                let index = this.items.comments.data.indexOf(item)
                this.items.comments.data.splice(index, 1);
            })
        },
        submitItem(){
            axios.post('/api/comments', this.commentForm)
            .then(response => {
                // if(this.commentsForm.id){
                //     let item = this.paramTypes.find(el => el.id == response.data.data.id)
                //     let index = this.paramTypes.indexOf(item);
                //     // this.paramTypes[index] = response.data.data <= taip nedaryti
                //     this.$set(this.paramTypes, index, response.data.data)
                // }else{
                    this.items.comments.data.push(response.data.data)
                // }
                this.refresh();
            })
            this.isModalVisible = false
        },
        refresh() {
            this.commentForm = _.cloneDeep(this.origCommentForm);
            this.fetchCommentData();
        }
    },
    computed: {
        authenticated(){
            return this.$store.getters['auth/authenticated'];
        },
        user(){
            return this.$store.getters['auth/user'];
        },
        userRole(){
            return this.user ? this.user.role_id : 0
        },
    },
}
</script>
<style>
    .comments {
        display: block;
        padding-bottom: 5vh;
    }
    .comments-header {
        background-image: url('/images/cup-phone.jpg');
        width: 100%;
        height: min(70vh, 70vw);
        max-height: 400px;
        background-size: cover;
        background-position:center;
        margin-bottom: 3%;
    }
    .add-comment {
        text-align: right;
        margin-right: 40px;
    }
    .add-comment-btn {
        font-family: "Oswald", sans-serif;
        padding: 0.2em 0.5em;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background-color: #fff;
        border: 1.5px solid #432310;
        color: #432310;
        border-radius: 2px;
        transition: 0.5s;
    }
    .add-comment-btn:hover {
        background-color: #432310;
        border: 1.5px solid #432310;
        color: #fff;
        transition: 0.5s;
    }
    .comments-title {
        background-color: rgb(252, 252, 252);
        width: 80vw;
        height: min(10vh, 10vw);
        max-height: 50px;
        margin: 0 auto;
        padding: min(min(4vh, 4vw), 14px) 0 0 0;
        position: absolute;
        top: min(min(63vh, 63vw), 365px);
        left: 10vw;
        display: block;
        font-size: min(6vw, 34px);
        font-family: "Oswald", sans-serif;
        color: #432310;
        letter-spacing: 0.08em;
        text-align: center;
        box-shadow: 0px 3px 3px #444;
        border-radius: 3px;
    }
    .comment {
        width: 96%;
        min-height: 100px;
        box-shadow: 0 2px 5px #444;
        margin: 20px auto;
        padding: 10px;
        border-radius: 1px;
    }
    .comment-delete {
        float: right;
        cursor: pointer;
    }
    .comment-delete-btn {
        font-weight: 600;
        font-size: 14px;
        color: #444;
        background-color: #fff;
        border: none;
        cursor: pointer;
    }
    /* .comment-header {

    } */
    .comment-stars {
        display: inline-block;
        margin: 2px 1px;
    }
    .comment-stars img {
        width: 20px;
        height: 20px;
    }
    .comment-name {
        font-family: "Open Sans", sans-serif;
        text-transform: uppercase;
        color: #432310;
        letter-spacing: -0.02em;
        margin-left: 5px;
    }
    .comment-data {
        margin: 5px;
        font-family: "Open Sans", sans-serif;
        color: #444;
        font-size: 13px;
        min-height: 30px;
        padding: 5px;
        border: 1px solid #f0f0f0;
    }
    .comments-data {
        padding: min(8vh, 8vw) 1vw;
    }
    @media (max-width: 1400px) {
    }
</style>
