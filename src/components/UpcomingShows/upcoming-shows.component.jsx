import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import './upcoming-shows.component.css'
class upcomingShowHome extends Component {
 
   
   
    render () {
      return (
        
        <section className="section-padding show-archive">
          <div className="container">
            <div className="d-flex justify-content-center row">
              <div className="col-xl-10">
                <div className="section-title style-four">
                  <h2>UPCOMING SHOWS</h2>
                </div>
                    <div className="single-show-ticket row no-guters">
                      <div className="col-sm-3 col-md-3 col-lg-3">
                        <div className="date-time">
                          <h6>15</h6>
                          <p>December, 2018</p>
                        </div>

                      </div>
                      <div className="col-sm-6 col-md-6 col-lg-7">
                        <h5>Dream Theatre (Live in London)</h5>
                        <p>23 Lee Rd, Blackheath, London SE3 9RQ, UK</p>
                      </div>
                      <div className="col-sm-3 col-md-3 col-lg-2">
                        <div className="a_hover">
                        <Link to="/">TICKETS</Link>
                          
                        </div>
                      </div>
                  </div>
                    <div className="single-show-ticket row no-guters">
                      <div className="col-sm-3 col-md-3 col-lg-3">
                        <div className="date-time">
                          <h6>15</h6>
                          <p>December, 2018</p>
                        </div>

                      </div>
                      <div className="col-sm-6 col-md-6 col-lg-7">
                        <h5>Dream Theatre (Live in London)</h5>
                        <p>23 Lee Rd, Blackheath, London SE3 9RQ, UK</p>
                      </div>
                      <div className="col-sm-3 col-md-3 col-lg-2">
                        <div className="a_hover">
                        <Link to="/">TICKETS</Link>
                         

                        </div>
                      </div>
                  </div>
            </div>
         </div>
      </div>
  </section>
          
	
	
			
	
         
       
          
        
      )
    }
  }
  export default upcomingShowHome;