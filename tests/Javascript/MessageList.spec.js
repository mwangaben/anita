import {
    mount
} from 'vue-test-utils';
import MessageList from '../../resources/assets/js/components/MessageList.vue';
import expect from 'expect';
import jest from 'jest-mock';


describe('MessageList', () => {
    let wrapper;
    beforeEach(() => {
        wrapper = mount(MessageList);
    })
    it('calls handleMessageClick when @messageClicked  happens', () => {
        // const stub = jest.fn()
        // wrapper.setMethods({
        //     handleMessageClick: stub
        // });

        // wrapper.update();
        // // wrapper.vm.$emit('messageClicked', 'hello')
        // // expect(stub).toBeCalled();
        // wrapper.vm.callB();
        // // expect(wrapper.vm.callB).toBeCalled();
        // // expect(wrapper.emitted().changed).toBe(true);
        // expect(wrapper.emitted().changed).toBeTruthy();
        // expect(stub).toBeCalled()
    });
});