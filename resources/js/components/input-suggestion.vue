<template>
  <div :class="wrapperClasses" ref="searchPosition" class="input-suggestion">
    <div
      :class="[{ 'input-suggestion-selected': value }, inputWrapperClasses]"
      class="input-suggestion-input-group"
    >
      <input
        v-model="searchText"
        :class="inputClasses"
        :placeholder="placeholder"
        :disabled="disabled"
        type="search"
        class="input-suggestion-input"
        @blur="blur"
        @focus="focus"
        @input="inputChange"
        @keydown.enter.prevent="keyEnter"
        @keydown.up.prevent="keyUp"
        @keydown.down.prevent="keyDown"
      />
      <slot name="searchSlot" />
    </div>
    <div
      class="main-input-suggestion-list-item scrollbar scrollbar-indigo bordered-indigo thin"
    >
      <slot v-if="loading" name="loading" class="input-suggestion-loading">
        Loading...
      </slot>
      <slot
        v-else-if="showList"
        :class="suggestionListClasses"
        name="suggestionList"
        class="input-suggestion-list"
      >
        <div
          v-for="group in itemGroups"
          :class="suggestionGroupClasses"
          :key="group.header"
        >
          <div
            v-if="itemGroups.length > 1 || group.header"
            :class="suggestionGroupHeaderClasses"
            class="input-suggestion-group-header"
          ></div>

          <div
            v-for="(item, i) in group.items"
            :key="i"
            :class="[
              { 'input-suggestion-item-active': i === cursor },
              suggestionItemWrapperClasses,
            ]"
            class="input-suggestion-list-item"
            @click="selectItem(item)"
            @mouseover="cursor = i"
          >
            <div
              :class="suggestionItemClasses"
              :is="itemTemplate"
              :item="item"
            />
          </div>
        </div>
      </slot>
    </div>
  </div>
</template>

<script>
import store from "../store";
import { environment_api } from "../env";

export default {
  name: "InputSuggestion",
  props: {
    itemTemplate: {
      type: Object,
      required: true,
    },
    minLen: { type: Number, default: 2 },
    value: {
      type: [Object, String, Number],
      default: null,
    },
    setLabel: { type: Function, default: (item) => item },
    items: { type: Array, default: () => [] },
    disabled: { type: Boolean, default: false },
    loading: { type: Boolean, default: false },
    placeholder: { type: String, default: "" },
    text: { type: String, default: "" },
    arindex: { type: Number, default: 0 },
    inputClasses: { type: String, default: "" },
    wrapperClasses: { type: String, default: "" },
    inputWrapperClasses: { type: String, default: "" },
    suggestionListClasses: { type: String, default: "" },
    suggestionGroupClasses: { type: String, default: "" },
    suggestionGroupHeaderClasses: { type: String, default: "" },
    suggestionItemWrapperClasses: { type: String, default: "" },
    suggestionItemClasses: { type: String, default: "" },
  },
  data() {
    return {
      EnvPath: environment_api.api_url,
      searchText: this.text,
      showList: true,
      cursor: 0,
    };
  },
  computed: {
    itemGroups() {
      return this.items.reduce((prv, crr) => {
        const foundGroup = prv.find((gr) => gr.header === crr.suggestionGroup);
        if (foundGroup) {
          foundGroup.items.push(crr);
        } else {
          prv.push({
            header: crr.suggestionGroup || "",
            items: [crr],
          });
        }
        return prv;
      }, []);
    },
  },
  watch: {
    value: {
      handler(value) {
        if (!value) {
          return;
        }
        this.searchText = this.setLabel(value);
      },
      deep: true,
    },
    "items.length": function () {
      // Items might be changed from Promise after searching
      // So we need the check if we should show the suggestion list
      this.showList = this.isAbleToShowList();
    },
  },
  created() {
    this.checkMissingProps();
  },
  mounted() {
    this.searchText = this.text;
    /*if (this.value) {
                this.searchText = this.setLabel(this.value);
            }*/
  },
  methods: {
    inputChange() {
      this.showList = this.isAbleToShowList();
      this.cursor = 0;
      this.$emit("onInputChange", this.searchText);
    },
    isAbleToShowList() {
      // return (this.searchText || '').length >= this.minLen && this.items.length > 0;
      return this.items.length > 0;
    },
    checkMissingProps() {
      if (!this.itemTemplate) {
        console.warn(
          "You need to pass `template` as the suggestion list item template"
        );
      }
    },
    convertHTMLEntity(html) {
      var txt = document.createElement("textarea");
      txt.innerHTML = html;
      return txt.value;
    },
    focus() {
      this.$emit("focus", this.searchText);
      if (this.isAbleToShowList() == false) {
        axios
          .get(this.EnvPath + "positions/" + this.searchText)
          .then(({ data }) => {
            if (data.status == 1) {
              store.commit("positionData", data.positions);
              for (let i = 0; i < this.$store.state.position_Data.length; i++) {
                this.items.push({
                  id: this.$store.state.position_Data[i].id,
                  name: this.$store.state.position_Data[i].title,
                  titleid: this.$store.state.position_Data[i].titleid,
                  content: this.convertHTMLEntity(
                    this.$store.state.position_Data[i].pos_description
                  ),
                  suggestionGroup: this.$store.state.position_Data[i].id,
                });
              }
              console.log(this.items);
            }
          });
      }
      this.showList = this.isAbleToShowList();
    },
    blur() {
      this.$emit("blur", this.searchText);
      // set timeout for the click event to work
      setTimeout(() => {
        this.showList = true;
      }, 200);
    },
    selectItem(item) {
      //console.log("test");
      if (item) {
        //console.log("test1");
        this.searchText = this.setLabel(item);
        this.$emit("onitemselected", item, this.arindex);
      }
      this.$emit("input", item);
    },
    keyUp() {
      this.$emit("keyUp", this.searchText);
      if (this.cursor > 0) {
        this.cursor -= 1;
      }
    },
    keyDown() {
      this.$emit("keyDown", this.searchText);
      if (this.cursor < this.items.length - 1) {
        this.cursor += 1;
      }
    },
    keyEnter() {
      if (this.showList && this.items[this.cursor]) {
        this.selectItem(this.items[this.cursor]);
        this.showList = false;
      }
      this.$emit("onEnter", this.items[this.cursor]);
    },
  },
};
</script>

<style>
.input-suggestion {
  position: relative;
}

.input-suggestion .input-suggestion-list {
  position: absolute;
}

.input-suggestion .input-suggestion-list .input-suggestion-list-item {
  cursor: pointer;
}

.input-suggestion
  .input-suggestion-list
  .input-suggestion-list-item.input-suggestion-item-active {
  background-color: #f3f6fa;
}
</style>
