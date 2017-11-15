import {mount} from 'vue-test-utils';
import About from '../../resources/assets/js/components/About.vue';
import expect from 'expect';
import Helpers from 'mwangaben-vthelpers';
import moxios from 'moxios';
import jest from 'jest-mock';


describe('About', () => {
     let wrapper, b;
     beforeEach(() => {

      moxios.install();
      wrapper = mount(About) 
      // wrapper.setData({ foo: {data : 'benny'} })
      wrapper.setComputed({
        isAdmin : true
        
      });
      wrapper.setData({
        datas : [ {
         quote: 'The quote',
         title : 'Hello world',
         body : 'Here is the body'	
       }
       ]
     });


      b = new Helpers(wrapper, expect);
    });

     afterEach(() => {
      moxios.uninstall();
    })

     it('it show the page title', (done) => {
          moxios.stubRequest('/about', {
            response : {
             status : 200,
             data : 'Okay'
           }
         });
          moxios.wait(() => {
           b.see('About');
           done()
         })
      });

      it('it can only be edited by admin', () => {
        wrapper.setComputed({ isAdmin : true})
        b.click('#edit');


        b.see('Editing Page');
        b.inputValueIs('Hello world', 'input[name=title]')
        b.inputValueIs('The quote', 'input[name=quote]')
        b.inputValueIs('Here is the body', 'textarea[name=body]')

      });

      it('it can be updated by the admin', (done) => {
          wrapper.setComputed({ isAdmin : true})
          b.click('#edit');

          b.see('Editing Page');

          b.type('New title', 'input[name=title]')
          b.type('New Quote', 'input[name=quote]')
          b.type('New body', 'textarea[name=body]')

          // moxios.stubRequest('/about\/\d+/', {
          //   response : 200
              
          // });

          moxios.stubRequest('/about/1', {
              response : 200
          })

          b.click('#update')
          // wrapper.vm.update();

          moxios.wait(() => {
            console.log(wrapper.emitted())
            // expect(wrapper.emitted().updated).toBeTruthy();
            done();
          })

      });






});