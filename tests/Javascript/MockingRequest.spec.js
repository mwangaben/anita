import {
	mount
} from 'vue-test-utils';
import MockingRequest from '../../resources/assets/js/components/MockingRequest.vue';
import expect from 'expect';
import moxios from 'moxios';


describe('MockingRequest', () => {
	moxios.install();
	let wrapper;
	beforeEach(() => {
		wrapper = mount(MockingRequest, {
			propsData: {
				dataQuestion: {
					title: 'The title',
					body: 'The body',
				}
			}
		});
	});

	afterEach(() => {
		moxios.uninstall();
	})

	it('it should have title and body', () => {
		see('The title');
		see('The body');
	});

	it('it can be edited', () => {
		hasNot('input[name=title]');
		hasNot('textearea[name=body]');

		click('.edit');
        
        inputValue('The title', 'input[name=title]');
        inputValue('The body', 'textarea[name=body]');

	});

	it('hides the edit button during editing mode', () => {
		wrapper.find('.edit').trigger('click');
		expect(wrapper.contains('.edit')).toBe(false);
	});

	it('it updates the question when the update is clicked', () => {
	
		click('.edit');

		type('Changed title', 'input[name=title]');
		type('Changed body', 'textarea[name=body]');

		moxios.stubRequest('/questions/1',{
  			status : 200,
  			response: {
  				title :  'Changed title',
  				body  :  'Changed body',
  			}
		});

  		

		click('.update');

		see('Changed title');
		see('Changed body');
	});

	it('it can cancel the editing', () => {
		click('.edit');

		type('Changed title', 'input[name=title]');

		click('.cancel');

		see('The title');
	});




	function see(text, selector) {
		let wrap = selector ? wrapper.find(selector) : wrapper;
		expect(wrap.html()).toContain(text);
	}

	function hasNot(selector) {
		expect(wrapper.contains(selector)).toBe(false);
	}

	function type(text, selector) {
		let node = wrapper.find(selector);
		node.element.value = text;
		node.trigger('input');
	}

	function click(selector) {
		wrapper.find(selector).trigger('click');
	}

	function inputValue(text , selector){
		expect(wrapper.find(selector).element.value).toBe(text);
	}
	
});