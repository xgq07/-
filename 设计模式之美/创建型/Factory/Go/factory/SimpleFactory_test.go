package factory

import (
	"reflect"
	"testing"
)

func TestNewIRuleConfigParser(t *testing.T)  {
	type args struct {
		typeName string
	}

	tests := []struct{
		name string
		args args
		want IRuleConfigParser
	}{
		{
			name:"json",
			args:args{typeName: "json"},
			want:jsonRuleConfigParser{},
		},
		{
			name:"yaml",
			args:args{typeName: "yaml"},
			want:yamlRuleConfigParser{},
		},
	}

	for _, tt := range tests{
		t.Run(tt.name, func(t *testing.T) {
			if got := NewIRuleConfigParser(tt.args.typeName); !reflect.DeepEqual( got, tt.want) {
				t.Errorf("NewIRuleConfigParserFactory() = %v, want %v", got, tt.want)
			}
		})
	}

}