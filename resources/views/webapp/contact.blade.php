@include('webapp.layout.header')

<style>
    /* Google Font CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');



.container .content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.container .content .left-side{
  width: 25%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  position: relative;
}

.content .left-side .details{
  margin: 14px;
  text-align: center;
}
.content .left-side .details i{
  font-size: 30px;
  color: #3e2093;
  margin-bottom: 10px;
}
.content .left-side .details .topic{
  font-size: 18px;
  font-weight: 500;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two{
  font-size: 14px;
  color: #afafb6;
}

  .container .content{
    flex-direction: column-reverse;
  }
 .container .content .left-side{
   width: 100%;
   flex-direction: row;
   margin-top: 40px;
   justify-content: center;
   flex-wrap: wrap;
 }
 .container .content .left-side::before{
   display: none;
 }
 
}


</style>
<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Contact Us</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; Contact Us</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->
    
<section class="testimonials">

  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
            <div class="topic">Address</div>
            <div class="text-one">Trade Tower, Kathmandu</div>
            <div class="text-two">Nepal</div>
        </div>
        <div class="phone details">
            <div class="topic">Phone</div>
            <div class="text-one">+977-9808374197</div>
            <div class="text-two">+977-9860943649</div>
        </div>
        <div class="email details">
            <div class="topic">Email</div>
            <div class="text-one">carbuyandsell@gmail.com</div>
        </div>
      </div>
      
      
    </div>
    </div>
  </div>


        
    </section>   




@include('webapp.layout.footer')

