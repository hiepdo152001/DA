<template>
    <div class="panel">
      <div class="panel-hdr">
        <h2 class="title" style="padding-top: 10px">Yêu cầu của tôi</h2>
        <div>
          <h2 style="padding: 10px 20px 0px 0px">
            Số ngày phép còn lại:
          </h2>
        </div>
      </div>
  
      <div class="panel-container">
        <div class="panel-content">
            <router-link :to="{name:'createReq'}">
            <button class="btn btn-primary waves-effect waves-themed" style="background-color: #886ab5;">
              + Thêm yêu cầu
            </button>
        </router-link>
        </div>
        <div class="panel-content">
          <table class="table table-bordered" style="margin-top: 30px">
            <thead>
              <tr>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Người xử lí</th>
                <th>Thời hạn</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
    
  </script>
  
  <style>
  .status {
    border-radius: 15px;
    width: 75%;
    margin: auto;
    padding: 4px 0px;
    text-align: center;
    font-weight: 600;
  }
  
  .page-content .panel {
    margin-bottom: 1.5rem;
  }
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
  .panel-hdr {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: space-between;
  
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background: #fff;
    min-height: 3rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 4px 4px 0 0;
    -webkit-transition: background-color 0.4s ease-out;
    transition: background-color 0.4s ease-out;
  }
  .panel .panel-container {
    position: relative;
    border-radius: 0 0 4px 4px;
  }
  .panel-container {
    margin-top: 30px;
  }
  .panel .panel-container .panel-content:only-child,
  .panel .panel-container .panel-content:last-child {
    border-radius: 0 0 4px 4px;
  }
  .panel-hdr > :first-child {
    padding-left: 1rem;
  }
  .table {
    margin-top: 30px;
    width: 100%;
    border-collapse: collapse;
  }
  .panel .panel-container .panel-content {
    padding: 0px 10px;
  }
  .contacts {
    margin: 20px;
  }
  
  .title {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .contact-row {
    border-bottom: 1px solid #ccc;
  }
  
  .contact-row:hover {
    background-color: #f5f5f5;
  }
  
.table-bordered th {
    font-size: 12px;
    text-align: center;
    font-weight: 700;
    padding: 12px!important;
    border: 1px solid #e9e9e9;
  }
  
  .table-bordered td {
    text-align: center;
    font-weight: 600;
    padding: 12px;
  }
  .table-bordered {
    border-collapse: collapse;
}
  
  .status-processing {
    color: #ff9800;
  }
  
  .status-completed {
    color: #4caf50;
  }
  
  .status-pending {
    color: #2196f3;
  }
  </style>
  