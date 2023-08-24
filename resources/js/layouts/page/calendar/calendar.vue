<template>
  <div class="panel">
    <div class="p-5">
      <div class="check-in-out" :class="{ 'd-none': off }">
        <button
          class="btn btn-danger btn-sm"
          v-if="showCheckOutButton"
          @click="options.customButtons.customButton.click"
        >
          <i class="bi bi-box-arrow-in-right"></i>
          {{ options.customButtons.customButton.text }}
        </button>
        <button
          class="btn btn-danger btn-sm"
          v-else
          @click="options.customButtons.customButton2.click"
        >
          <i class="bi bi-box-arrow-right"></i>
          {{ options.customButtons.customButton2.text }}
        </button>
      </div>
      <FullCalendar :options="options" ref="calendarRef" />
    </div>
  </div>
</template>
<script>

import { ref, onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listGridPlugin from "@fullcalendar/list";
import interactionGridPlugin from "@fullcalendar/interaction";
import ApiService from "../../../service/calendarService.js";
import axios from "axios";
import AppService from "../../../service/ApiService";


export default {
  components: {
    FullCalendar,
  },
  setup() {
    const calendarRef = ref(null);
    const showCheckOutButton = ref(true);
    const off = ref(false);
    onMounted(async () => {
      const calendarApi = calendarRef.value.getApi();
      AppService.get('http://localhost:8000/api/calendar/holiday').then(response=>{
        ApiService.holiday(options,calendarApi,response.data);
      })
      
      AppService.get('http://localhost:8000/api/calendar/time-keep/all').then(response=>{
        response.data.forEach(element => {
          ApiService.addEvent(options,calendarApi,element.time_in);
          ApiService.addEvent(options,calendarApi,element.time_out);
        });
      })
      AppService.get('http://localhost:8000/api/calendar/time-keep/by-day').then(response=>{
        if(Object.keys(response.data).length > 0){
          ApiService.checkView(response.data.time_in,response.data.time_out,showCheckOutButton,off);
        }
      })
    });
    
    const options = {
      plugins: [
        dayGridPlugin,
        timeGridPlugin,
        listGridPlugin,
        interactionGridPlugin,
      ],
      initialView: "dayGridMonth",
      headerToolbar: {
        left: "title",
        center: "",
        right: "today prev,next",
      },
      weekends: true,
      firstDay: 1,
      events: [],

      customButtons: {
        customButton: {
          text: "Check-in",
          click: async function () {
            const calendarApi = calendarRef.value.getApi();
              axios.post('http://localhost:8000/api/calendar/time-keep/check-in').then(response => {
                if(response.status===200){
                  ApiService.addEvent(options,calendarApi,response.data.time_in);
                  showCheckOutButton.value=false;
                }
              });
          }
        },
        customButton2: {
          text: "Check-out",
          click: async function () {
            const calendarApi = calendarRef.value.getApi();
            try {
              if (confirm("Bạn muốn check-out ngay bây giờ ?")) {
                axios.post('http://localhost:8000/api/calendar/time-keep/check-out').then(response => {
                if(response.status===200){
                  console.log(response.data.time_out);
                  ApiService.addEvent(options,calendarApi,response.data.time_out);
                  off.value = true;
                }
              });
              }
            } catch (error) {}
          },
        },
      }
    };
    return {
      options,
      calendarRef,
      showCheckOutButton,
      off,
      // checkClick,
    };
  },
};
</script>

<style>
.panel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  margin-bottom: 1.5rem;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-bottom: 1px solid #e0e0e0;
  border-radius: 4px;
  -webkit-transition: border 500ms ease-out;
  transition: border 500ms ease-out;
}
.fc-event-title {
  font-weight: 600;
}
.fc .fc-scrollgrid-liquid {
  height: 85% !important;
}

.check-in-out {
  position: absolute;
  right: 25%;
}
.btn {
  padding: 7px 10px;
}
.fc-daygrid-day-events {
  display: flex;
  justify-content: center;
}
.fc-event-title {
  padding: 0px 8px !important;
}
.fc-day-sat {
  background-color: #ccbfdf;
}
.fc-day-sun {
  background-color: #ccbfdf;
}
.fc-daygrid-day-number {
  color: #7777;
  font-size: 18px;
  font-weight: 600;
}
.fc-col-header-cell {
  background-color: #886ab5;
  padding: 10px !important;
}
.fc-col-header-cell-cushion {
  color: white;
  font-weight: 500px;
  font-size: 20px;
}

.fc-prev-button,
.fc-next-button,
.fc-today-button {
  background-color: #886ab5 !important ;
}
.fc-icon {
  font-size: 16px !important;
}
.fc-theme-standard td,
.fc-theme-standard th {
  border: 1px solid #886ab5 !important;
}
.fc-view-harness {
  height: 677px !important;
}
.fc .fc-scrollgrid-liquid {
  height: 100% !important;
}
</style>
