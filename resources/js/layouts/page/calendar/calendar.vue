<template>
  <div class="panel" style="margin: 50px 30px 0px 30px;">
    <div class="p-4">
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
import rrule from "@fullcalendar/rrule";
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
      AppService.get('http://localhost:8000/api/calendar/holiday/all').then(response=>{
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
        rrule
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
    };
  },
};
</script>

<style>
/* .fc-daygrid-day-events {
  display: flex;
  flex-wrap: wrap;
}
.fc-daygrid-event-harness{
  flex: 1;
  
}
.fc-daygrid-event-harness:nth-child(3) {
  flex-basis: 100%;
}
.fc-event-title {
 
} */
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
