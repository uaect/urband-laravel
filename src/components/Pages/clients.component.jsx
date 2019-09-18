import React , {Component} from 'react';
import Carousel from "react-multi-carousel";
import { library } from '@fortawesome/fontawesome-svg-core'
import { faQuoteLeft,faQuoteRight } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { Link } from 'react-router-dom'

library.add(faQuoteLeft,faQuoteRight)

class Clients extends React.Component{

    render(){

        const responsive = {
            superLargeDesktop: {
              // the naming can be any, depends on you.
              breakpoint: { max: 4000, min: 3000 },
              items: 3,
            },
            desktop: {
                breakpoint: { max: 3000, min: 1024 },
                items: 3,
              },
              tablet: {
                breakpoint: { max: 1024, min: 464 },
                items: 2,
              },
              mobile: {
                breakpoint: { max: 464, min: 0 },
                items: 1,
              },
            };
    

        return (
           
         <div>
             <section className="page-header artist-banner">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                        <h3>We Have Recorded More than 100+</h3>
                        <h2>Clients</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>Clients</span>
                        </div>

                    </div>
		
                </section>  

                <section>
                    <div className="page-padd">
                        <div className="container">
                            <div className="row">
                                <div className="text-center page-head">What our clients say</div>
                                    <div className="client-Wrapper">
                                        <FontAwesomeIcon icon={faQuoteLeft} className="quote left"/>
                                        <FontAwesomeIcon icon={faQuoteRight} className="quote right"/>
                                        <div className="col-md-12">
                                            <Carousel responsive={responsive}
                                            showDots={true}
                                            arrows={false}
                                            dotListClass="custom-dot-list-style">
                                               <div className="client-avathar">
                                                    <img src={require('../../media/schedule/1.jpg')} alt="thumb" className="rounded-circle"/>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.Eos expedita, doloremque sequi blanditiis perspiciatis rerum velit maiores omnis modi voluptate est veniam
                                                    </p>
                                                    <div className="name">
                                                        <span>-</span> John Doe
                                                    </div>
                                                </div>
                                                <div className="client-avathar">
                                                    <img src={require('../../media/schedule/1.jpg')} alt="thumb" className="rounded-circle"/>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.Eos expedita, doloremque sequi blanditiis perspiciatis rerum velit maiores omnis modi voluptate est veniam
                                                    </p>
                                                    <div className="name">
                                                        <span>-</span> John Doe
                                                    </div>
                                                </div>
                                                <div className="client-avathar">
                                                    <img src={require('../../media/schedule/1.jpg')} alt="thumb" className="rounded-circle"/>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.Eos expedita, doloremque sequi blanditiis perspiciatis rerum velit maiores omnis modi voluptate est veniam
                                                    </p>
                                                    <div className="name">
                                                        <span>-</span> John Doe
                                                    </div>
                                                </div>
                                                <div className="client-avathar">
                                                    <img src={require('../../media/schedule/1.jpg')} alt="thumb" className="rounded-circle"/>
                                                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.Eos expedita, doloremque sequi blanditiis perspiciatis rerum velit maiores omnis modi voluptate est veniam
                                                    </p>
                                                    <div className="name">
                                                        <span>-</span> John Doe
                                                    </div>
                                                </div>
                                            </Carousel>
                                        </div> 
                                    </div>  
                         </div>
                    </div>   
                    </div>     
                </section>

                <section className="partners-area">
                    <div className="container">
                        <div className="d-flex justify-content-center row">
                            <div className="col-xl-10">

                                <div className="row">
                                    <div className=" col-md-5">
                                        <div className="section-title style-five float-left">
                                            <h2>OUR Clients</h2>
                                            <p>There are many variations of passages of Lorem Ipsum available but the majority. We are proud there are many variations of passages of Lorem Ipsum available.</p>
                                        </div>
                                    </div>
                                    <div className="col-md-7">
                                        <ul className="client-list">
                                            <li><img src={require('../../media/logo/1.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/2.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/3.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/4.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/5.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/3.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/4.png')} alt="thumb"/></li>
                                            <li><img src={require('../../media/logo/5.png')} alt="thumb"/></li>
                                        </ul>
                                    </div>
                                


                                </div>
                                
                            </div>
                        
                        </div>
                        
                    </div>
		</section>

         



      
       
				

	
		</div>
           
           
        );
    }
}

export default Clients;




