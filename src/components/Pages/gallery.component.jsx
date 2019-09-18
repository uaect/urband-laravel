import React , {Component} from 'react';
import { Link } from 'react-router-dom'
import { Tabs, Tab, TabPanel, TabList } from 'react-web-tabs';
import 'react-web-tabs/dist/react-web-tabs.css';
import  { useState } from 'react';
import FsLightbox from 'fslightbox-react';

function Gallery() {

    const [lightboxController, setLightboxController] = useState({
        toggler: false,
        sourceIndex: 0
        });
        
        function openLightboxOnSourceIndex(sourceIndex) {
        setLightboxController({
        toggler: !lightboxController.toggler,
        sourceIndex: sourceIndex,
        });
        }
        return (
           
            <div>
                 <section className="page-header artist-banner">
                    <div className="tim-container">
                        <div className="page-header-title text-center">
                        <h2>Gallery</h2>
                        </div>

                        <div className="breadcrumbs">
                        <Link to="/">Home</Link>
                            <span>/</span>
                            <span>Gallery</span>
                        </div>

                    </div>
                </section>  

                <section  className="section-padding">
                    <div className="tim-container">
                        <div className="section-title style-four text-center">
                            <h2>Music Gallery</h2>
                        </div>

                    <div className="tim-isotope tim-isotope-2">
                        <Tabs
                            defaultTab="All"
                            onChange={(tabId) => { console.log(tabId) }}
                        >
                            <div className="tim-isotope-filter album-filter-button album-filter-button-two">
                            <TabList>
                            <Tab tabFor="All">All</Tab>
                            <Tab tabFor="Drum">Drum</Tab>
                            <Tab tabFor="Guiter">Guiter</Tab>
                            <Tab tabFor="Bass">Bass</Tab>
                            <Tab tabFor="Piano">Piano</Tab>
                            </TabList>
                           </div> 
                           <div className="col-xl-10 mx-auto">  
                            <TabPanel tabId="All">
                            <ul class="tim-filter-items tim-album-items grid">
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <Link onClick={ () => openLightboxOnSourceIndex(1) }>
                                        <img src={require('../../media/gallery/1.jpg')} alt="album thumb" />
                                        </Link>
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <Link onClick={ () => openLightboxOnSourceIndex(2) }>
                                            <img src={require('../../media/gallery/2.jpg')} alt="album thumb" />
                                        </Link>
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <Link onClick={ () => openLightboxOnSourceIndex(3) }>
                                            <img src={require('../../media/gallery/3.jpg')} alt="album thumb" />
                                        </Link>
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <Link onClick={ () => openLightboxOnSourceIndex(4) }>
                                            <img src={require('../../media/gallery/4.jpg')} alt="album thumb" />
                                        </Link>
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                

                            </ul>
                            </TabPanel>
                            <TabPanel tabId="Drum">
                            <ul class="tim-filter-items tim-album-items grid">
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <Link onClick={ () => openLightboxOnSourceIndex(1) }>
                                        <img src={require('../../media/gallery/1.jpg')} alt="album thumb" />
                                        </Link>
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <Link onClick={ () => openLightboxOnSourceIndex(2) }>
                                            <img src={require('../../media/gallery/2.jpg')} alt="album thumb" />
                                        </Link>
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <img src={require('../../media/gallery/2.jpg')} alt="album thumb" />
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                                <li className="tim-album-item grid-item">
                                    <div className="tim-isotope-grid__img effect-active">
                                        <img src={require('../../media/gallery/2.jpg')} alt="album thumb" />
                                    </div>
                                   
                                    <div className="gallery_details_wrap">
                                        <div className="gallery-info">

                                            <h4 className="album-title">Hot Party</h4>
                                            <h5 className="artist-name">Music on Night</h5>

                                        </div>
                                    </div>
                                </li>
                               

                            </ul>
                            </TabPanel>
                            <TabPanel tabId="Guiter">
                            <p>Tab 3 content</p>
                            </TabPanel>
                        </div>    
                        </Tabs>

                        <FsLightbox
                        toggler={ lightboxController.toggler }
                        sources={ [
                         require('../../media/gallery/1.jpg'),
                         require('../../media/gallery/2.jpg'),
                         require('../../media/gallery/3.jpg'),
                         require('../../media/gallery/4.jpg')
                        ] }
                        />
                 
                </div>       





                    </div>
                </section>
            </div>
        );
    }


export default Gallery;



