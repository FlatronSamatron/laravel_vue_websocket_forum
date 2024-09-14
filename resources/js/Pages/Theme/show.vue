<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import {HeartIcon, PhotoIcon} from "@heroicons/vue/24/outline/index.js";
import {ref, useTemplateRef} from "vue";

const props = defineProps({
  theme: Object,
  auth: Object
})

const editor = useTemplateRef('editor')
const image = useTemplateRef('image')

const complaintHandler = (message) => {
  message.isComplaint = !message.isComplaint
  message.complaint = ''
}

const store = () => {
  axios.post(route('messages.store'), {
    content: editor.value.innerHTML,
    theme_id: props.theme.id
  }).then((res) => {
    props.theme.messages.push(res.data)
    editor.value.innerHTML = ''
  })
}

const storeImage = (e) => {
  const file = e.target.files[0]
  const formData = new FormData()
  formData.append('image', file)

  axios.post(route('images.store'), formData).then(res => {
    editor.value.innerHTML = `<span hidden>img_id=${res.data.id}</span><img src=${res.data.url} alt="image">`
  })
}

const quote = (message) => {
  editor.value.innerHTML = `<blockquote>${message.content}</blockquote><br/>`
}

const complaint = (message) => {
  axios.post(route('messages.complaint', message.id), {
    body: message.complaint,
    theme_id: message.theme_id
  }).then(() => {
    message.complaint = ''
    message.isComplaint = false
    message.is_complained = true
  })
}



const reply = (message) => {
  const replyFrom = props.auth.user.name
  const title = `<div class="w-full bg-gray-100 border border-gray-200 p-2">
    Reply to @${message.user.id} ${message.user.name} from ${replyFrom}
    <span></span>
  </div>`
  editor.value.innerHTML = `${title}<blockquote style="">${message.content}</blockquote><br/>`
}

const likeToggle = (message) => {
  axios.post(route('messages.like', message.id)).then(() => {
    message.is_liked ? message.likes-- : message.likes++
    message.is_liked = !message.is_liked
  })
}

</script>

<template>
  <MainLayout>
    <h3 class="text-xl mb-3">{{theme.title}}</h3>
    <div v-for="message in theme.messages" :id="message.id" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow mb-3">
      <div class="w-full flex">
        <div class="w-1/6 flex flex-col justify-center items-center p-3 border-r border-gray-200">
          <div class="w-24 h-24 overflow-hidden bg-sky-500 rounded-full">
            <img :src="message.user.avatar" :alt="message.user.name">
          </div>
          <div>{{message.user.name}}</div>
        </div>
        <div class="flex p-3 flex-col justify-between w-full">
          <p class="text-gray-300">{{message.time}}</p>
          <p v-if="message.is_complained" class="bg-red-200 p-2 rounded-md my-2 border border-red-300">Your complaint is pending</p>
          <div v-html="message.content"></div>
          <div class="flex justify-between items-center mt-4">
            <div class="flex items-center">
              <span class="mr-2 text-[20px]">{{message.likes}}</span>
              <HeartIcon :class="{ 'fill-sky-600' : message.is_liked }" class="size-6 cursor-pointer stroke-sky-600" @click="likeToggle(message)"/>
            </div>
            <div class="flex w-1/3">
              <div v-if="!message.is_complained" @click="complaintHandler(message)" class="mr-3 w-1/2 p-2 cursor-pointer rounded-md bg-red-500 text-white text-center hover:bg-red-400 transition-all">
                Complaint
              </div>
              <div @click="quote(message)" class="mr-3 w-1/2 p-2 cursor-pointer rounded-md bg-sky-500 text-white text-center hover:bg-sky-400 transition-all">
                Quote
              </div>
              <div @click="reply(message)" class="w-1/2 p-2 cursor-pointer rounded-md bg-white border border-sky-600 text-sky-600 text-center hover:bg-sky-500 hover:text-white transition-all">
                Reply
              </div>
            </div>
          </div>
          <div v-if="message.isComplaint" class="py-4">
            <textarea v-model="message.complaint" rows="3" class="block p-2.5 w-full text-gray-900 bg-white rounded-lg border border-gray-300 mb-4" placeholder="complaint"></textarea>
            <div @click="complaint(message)" class="p-2 w-full cursor-pointer rounded-md bg-red-500 border-sky-600 text-white text-center hover:bg-red-400 transition-all">
              Submit
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white rounded-lg border border-gray-300 p-4">
      <h3 class="text-xl mb-3">Add Message:</h3>
      <div class="bg-gray-50 border border-gray-100 w-full p-2 rounded-md mb-2">
        <PhotoIcon @click="image.click()" class="size-6 cursor-pointer"/>
        <input @input="storeImage" ref="image" type="file" hidden>
      </div>
      <div ref="editor" contenteditable="true" class="p-2.5 w-full text-gray-900 bg-white rounded-lg border border-gray-300 mb-5">
      </div>
      <div @click="store" class="p-2 w-full cursor-pointer rounded-md bg-sky-500 border-sky-600 text-white text-center hover:bg-sky-400 transition-all">
        Submit
      </div>
    </div>
  </MainLayout>
</template>

<style>
blockquote {
  display: block;
  padding: 4px;
  border-left: 4px solid #a0aec0;
  background: #f6f6f6;
}
</style>