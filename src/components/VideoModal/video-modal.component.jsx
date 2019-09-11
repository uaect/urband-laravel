import React, { Component } from 'react'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlay } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import ModalVideo from 'react-modal-video'
import '../../../node_modules/react-modal-video/css/modal-video.min.css'
library.add(faPlay)


class ModalVideoComponent extends Component {
 
    constructor () {
      super()
      this.state = {
        isOpen: false
      }
      this.openModal = this.openModal.bind(this)
    }
   
    openModal () {
      this.setState({isOpen: true})
    }
   
    render () {
      return (
        <div className="btn-wrap"> 
          <div onClick={this.openModal}>
            <div className="video-btn-three popup-video-btn">
						    <FontAwesomeIcon icon={faPlay} />
						</div>
          </div>
          <ModalVideo channel='youtube' isOpen={this.state.isOpen} videoId='L61p2uyiMSo' onClose={() => this.setState({isOpen: false})} />
          
        </div>
       
          
        
      )
    }
  }
  export default ModalVideoComponent;