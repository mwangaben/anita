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
  wrapper.setData({ foo: {data : 'benny'} })
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

 it.only('it can be edited', () => {
      // console.log(wrapper.vm.isAdmin);

       b.click('#edit');
     

     b.see('Editing Page');
     b.inputValueIs('Hello world', 'input[name=title]')
     b.inputValueIs('The quote', 'input[name=quote]')
     b.inputValueIs('Here is the body', 'textarea[name=body]')

 });

 it('it can be updated', (done) => {
    b.click('#edit');

    b.see('Editing Page');

    b.type('New title', 'input[name=title]')
    b.type('New Quote', 'input[name=quote]')
    b.type('New body', 'textarea[name=body]')

    moxios.stubRequest('/about\/\d+/', {
        response : {
            status : 200,
            message : 'Okay'
        }
    });

    b.click('#update')

    moxios.wait(() => {
        expect(wrapper.emitted().updated).toBeTruthy();
        done();
    })

});

 it('it check events', () => {
    // b.click('#chai')
     let cmp = wrapper;
    const stub = jest.fn()
    cmp.vm.$on('chai', stub)
    cmp.vm.chai()
    // 
      // wrapper.vm.chai()

       expect(wrapper.emitted().chad).toBeTruthy();
    // expect(stub).toBeCalledWith('chad')
       // done()
});





});