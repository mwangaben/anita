import {
	mount
} from 'vue-test-utils';
import MockingRequest from '../../resources/assets/js/components/MockingRequest.vue';
import expect from 'expect';
import moxios from 'moxios';
import Helpers from 'mwangaben-vthelpers';


describe('MockingRequest', () => {
	let wrapper, b;
	
	beforeEach(() => {
	 moxios.install();

		wrapper = mount(MockingRequest, {
			propsData: {
				dataQuestion: {
					title: 'The title',
					body: 'The body',
				}
			}
		});

		b = new Helpers(wrapper, expect);
	});

	afterEach(() => {
		moxios.uninstall();
	})

	it('it should have title and body', () => {
		b.see('The title');
		b.see('The body');
	});

	it('it can be edited', () => {
		b.domHasNot('input[name=title]');
		b.domHasNot('textearea[name=body]');

		b.click('.edit');
        
        b.inputValueIs('The title', 'input[name=title]');
        b.inputValueIs('The body', 'textarea[name=body]');

	});

	it('hides the edit button during editing mode', () => {
		wrapper.find('.edit').trigger('click');
		expect(wrapper.contains('.edit')).toBe(false);
	});

	it('it updates the question when the update is clicked', (done) => {
	
		b.click('.edit');

        b.see('Update');
        b.see('Cancel');

		b.type('Changed title', 'input[name=title]');
		b.type('Changed body', 'textarea[name=body]');

		b.inputValueIs('Changed title', 'input[name=title]');

		moxios.stubRequest("/questions", {
			status : 200, 
			response : {
				title : 'The title',
				body : 'The body'
			}
		});

		b.click('#update');

		b.see('Changed title');
		b.see('Changed body');
		moxios.wait(() => {
			b.see('Your question has been updated');
 			done();
		})
	});

	it('it can cancel the editing', () => {
		b.click('.edit');

		b.type('Changed title', 'input[name=title]');

		b.click('.cancel');

		b.see('The title');
	});



	
	
});